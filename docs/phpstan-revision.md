# Revisión de errores PHPStan

- **Herramienta:** PHPStan 2.3.3, `level: 5`
- **Configuración:** [phpstan.neon](../phpstan.neon) (`paths: .`, excluye solo `vendor`)
- **Fecha del análisis:** 2026-10-28
- **Total:** 622 errores en 52 archivos

> **¿Dónde queda registrado el resultado?** PHPStan **no guarda el reporte en ningún archivo**: lo imprime solo en la terminal. Lo único que escribe en disco es un caché interno (`resultCache.php`) en la carpeta temporal del sistema (`%TEMP%\phpstan\`), que no sirve para leer los errores.
> Para guardar el reporte en un archivo:
>
> ```bash
> php vendor/bin/phpstan analyse --no-progress > phpstan-reporte.txt
> php vendor/bin/phpstan analyse --no-progress --error-format=json > phpstan-reporte.json
> ```

---

## 1. Resumen: de dónde salen los 622 errores

| Origen | Errores | ¿Es código a corregir? |
|---|---:|---|
| `storage/framework/views/*.php` (vistas Blade compiladas) | 256 | **No.** Es caché generado por Laravel. Se excluye en la config |
| `app/Http/Controllers` | 179 | Sí |
| `app/Models` | 116 | Sí (en su mayoría PHPDoc mal escrito) |
| `tests/` | 38 | Parcial (la mayoría desaparece con Larastan) |
| `routes/` | 18 | Parcial |
| `database/` | 7 | Parcial |
| Otros (`app/View`, `app/Providers`, `app/Http/Middleware`, `config`, `resources/lang`) | 8 | Sí |

### Por tipo de error

| Identificador | Cantidad | Causa principal |
|---|---:|---|
| `variable.undefined` | 172 | 171 en vistas compiladas de `storage/` → se ignora |
| `property.notFound` | 100 | PHPStan no conoce los atributos mágicos de Eloquent ni los campos del `Request` → **falta Larastan** |
| `class.notFound` | 79 | Tipos de retorno `Response` / `RedirectResponse` sin `use`, controladores inexistentes en `routes/auth.php` |
| `phpDoc.parseError` | 79 | PHPDoc mal formado: `@property $x` sin tipo, `@return Tipo , texto` (coma) |
| `return.type` | 45 | El tipo declarado en PHPDoc no coincide con lo que se devuelve |
| `nullCoalesce.offset` | 44 | Todas en vistas compiladas → se ignora |
| `class.nameCase` | 32 | Clases referenciadas con mayúsculas/minúsculas distintas al nombre real |
| `staticMethod.notFound` | 18 | `User::where()`, `Cloudinary::upload()`… → **falta Larastan** |
| Otros | 53 | Ver detalle por archivo |

---

## 2. Paso previo: corregir la configuración (baja ~400 errores sin tocar código)

### 2.1 Instalar Larastan

PHPStan "puro" no entiende Laravel (facades, modelos Eloquent, `$request->campo`, relaciones). Eso genera cientos de falsos positivos (`property.notFound`, `staticMethod.notFound`, `method.notFound`).

El proyecto usa **Laravel 8**, así que la versión compatible es **Larastan 1.x**, que usa **PHPStan 1.x**. PHPStan 2.3 (el que está instalado ahora) **no es compatible** con Larastan para Laravel 8.

```bash
composer remove --dev phpstan/phpstan
composer require --dev nunomaduro/larastan:^1.0
```

> Si después se migra a Laravel 10/11, se puede pasar a `larastan/larastan:^2` o `^3` con PHPStan 2.

### 2.2 Ajustar `phpstan.neon`

```neon
includes:
    - ./vendor/nunomaduro/larastan/extension.neon

parameters:
    level: 5
    phpVersion: 80300          # PHP 8.3 (composer.json dice ^7.3, por eso PHPStan
                               # se queja de "named arguments" en tests/Feature/serParteTest.php:112)
    paths:
        - app
        - config
        - database
        - routes
        - tests
    excludePaths:
        - routes/auth.php      # archivo de Breeze que no se carga (ver sección 4)
```

Con esto quedan fuera `storage/`, `vendor/`, `node_modules/`, `public/` y `docs/`, que no son código a analizar.

> Recomendación: después de este paso, **volver a correr el análisis** y trabajar sobre la lista nueva. Lo que sigue en este documento son los errores que se mantienen igual o que son errores reales.

---

## 3. Errores reales (prioridad alta): bugs de lógica

Estos errores apuntan a fallas que **ya pueden estar rompiendo** el sistema o abriendo problemas de seguridad.

### 3.1 [app/Http/Controllers/Auth/LoginController.php](../app/Http/Controllers/Auth/LoginController.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 63 | `User::where()` no encontrado | Falso positivo (se va con Larastan). |
| 67 | — | ⚠️ **Seguridad:** `$user->assignRole('admin')` le da rol de **administrador a cualquier usuario que inicie sesión**. Hay que quitarlo. |
| 69 | `deadCode.unreachable` | `return redirect('/showLogin');` después de otro `return`: nunca se ejecuta. Borrar. |
| 75 | `deadCode.unreachable` | `return redirect($redirectTo);` después de otro `return`: nunca se ejecuta. Borrar. |

### 3.2 [app/Http/Requests/validacionNoticia.php](../app/Http/Requests/validacionNoticia.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 22-30 | `argument.type` en `validate()` | Un `FormRequest` tiene un método `store()` que llama a `$this->validate($request, $this->rules())`. `FormRequest::validate()` espera un array de reglas, no un `Request`. Ese método es lógica de controlador puesta en la clase equivocada: **sacarlo del FormRequest** (la validación ya se hace sola con `rules()`; el chequeo del honeypot `oculto` va en el controlador o en `prepareForValidation`). |

### 3.3 [app/Http/Controllers/administradorController.php](../app/Http/Controllers/administradorController.php) — `eliminarEmprendimiento()`

| Línea | Error | Qué revisar |
|---|---|---|
| 479 | `property.notFound` | `imagenes::find($emprendimiento->id)` **funcionaba bien**: el modelo `Imagenes` redefine `find()` para buscar por `emprendedor_id` ([Imagenes.php:65](../app/Models/Imagenes.php#L65)). Igual se cambió a `$emprendimiento->imagenes`, que da el mismo resultado y es más claro. **Queda pendiente** renombrar el `find()` redefinido (ver MIGRACION.md 3.6). |
| 481 | `return.missing` | Si `$redes` o `$direccion` son `null`, el método termina **sin devolver respuesta**. Agregar un `return redirect()->back()->with('error', ...)` al final. |
| 333 | `argument.type` | `Imagenes::eliminarImagen()` recibe un `Builder` y no una `Imagenes`. Revisar si falta `->first()` / `->get()` en la consulta de la línea ~330. |
| 330-332 | `property.notFound` en `Builder::$id`, `$public_id` | Mismo problema: se usa una consulta sin ejecutar (`where(...)` sin `->first()`) como si fuera un modelo. |

### 3.4 [app/Http/Middleware/Authenticate.php](../app/Http/Middleware/Authenticate.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 17 | `return.missing` | Si la petición espera JSON no hay `return`. Agregar `return null;` al final. |

### 3.5 [app/Models/Noticias.php](../app/Models/Noticias.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 58 | `return.type` | `getUltimasNoticias()` usa `paginate()` → devuelve `LengthAwarePaginator`, no `Collection`. Corregir el `@return`. (Esto también arregla [noticiasController.php:34](../app/Http/Controllers/noticiasController.php#L34) `perPage()` no encontrado.) |
| 72 | `return.missing` | `showNoticiasId()` no devuelve nada si no encuentra la noticia. Agregar `return null;` y declarar `@return Noticias|null`. Más simple: `return Noticias::find($id);`. |
| 88 | `return.type` | `obtenerCategoriasNoticias()` devuelve `Support\Collection`, no `Eloquent\Collection`. |
| 147 | `return.type` | `createNoticia()` devuelve el modelo creado. Cambiar `@return Response` por `@return Noticias`. |
| 159 | `return.missing` | `editNoticia()` no devuelve nada. Cambiar `@return Response` por `@return void` (o `bool` y devolver `$noticia->save()`). |
| 167, 181 | `class.notFound` `App\Models\Response` | `deleteNoticia()` / `editarImagen()`: `Response` no existe en ese namespace. Corregir el `@return`. |

### 3.6 [app/Models/Imagenes.php](../app/Models/Imagenes.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 84-86 | `class.notFound` / `return.missing` | `eliminarImagen()` no devuelve nada; el PHPDoc dice `@return Response`. Cambiar a `@return void`. |

### 3.7 [app/Models/Emprendedor.php](../app/Models/Emprendedor.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 128 | `return.type` | `showEmprendimientos()` puede devolver `null`. Declarar `@return Collection|null`, o mejor devolver siempre la colección (vacía si no hay datos) y revisar los lugares que la usan. |
| 222-224 | `class.notFound` `Illuminate\Http\Collection` | Esa clase no existe. Debe ser `\Illuminate\Support\Collection`. |

### 3.8 [app/Models/Horario.php](../app/Models/Horario.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 29 | `class.notFound` `Carbon\Carbon\null`, `Carbon\Carbons\null` | Error de tipeo en `@property`: debe ser `\Carbon\Carbon|null`. |
| 37 | `property.phpDocType` | `$fillable` documentado como `mixed`; usar `@var array<int, string>`. |
| 70 | `class.notFound` | `crearHorario()`: `@param` con `Carbon\Carbons\null` y `@return Response`. Corregir a `\Carbon\Carbon|null` y `@return Horario`. |
| 130 | `phpDoc.parseError` | `@param <App><Model>horario $horarios ,...` → `@param Horario $horarios ID del horario seleccionado.` |

### 3.9 [routes/web.php](../routes/web.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 30 | `Route::PATCH()` | Funciona porque PHP no distingue mayúsculas en métodos, pero lo correcto es `Route::patch()`. |
| 31 | `Route::DELETE()` | Igual: `Route::delete()`. |
| 66 | `Auth` clase desconocida | Agregar `use Illuminate\Support\Facades\Auth;` al principio del archivo. |

### 3.10 [resources/lang/es/validation.php](../resources/lang/es/validation.php)

| Línea | Error | Qué revisar |
|---|---|---|
| 58 y 120 | `array.duplicateKey` `'image'` | La clave `'image'` está dos veces; **la segunda pisa a la primera** (el mensaje de la regla `image` termina siendo "La imagen es necesaria"). Dejar una sola. Si el texto de la línea 120 es un mensaje personalizado para un campo, va dentro de `'custom'`. |
| 148 y 182 | `array.duplicateKey` `'city'` | Clave repetida dentro de `attributes`. Borrar una. |

---

## 4. Archivos / clases que no existen

### 4.1 [routes/auth.php](../routes/auth.php) (14 errores, líneas 14-54)

Hace referencia a controladores de **Laravel Breeze** (`RegisteredUserController`, `AuthenticatedSessionController`, `PasswordResetLinkController`, `NewPasswordController`, `EmailVerificationPromptController`, `VerifyEmailController`, `EmailVerificationNotificationController`, `ConfirmablePasswordController`) que **no existen** en `app/Http/Controllers/Auth/`.
El archivo **no se carga en ningún lado** (las rutas de auth salen de `Auth::routes()` en `web.php`). → **Se puede borrar** o excluir del análisis.

### 4.2 [config/permission.php:139](../config/permission.php#L139)

`Spatie\Permission\DefaultTeamResolver` no existe en la versión instalada de `spatie/laravel-permission`. Probablemente el archivo de config se publicó desde una versión más nueva que la instalada. Comparar con el config de la versión instalada (`vendor/spatie/laravel-permission/config/permission.php`) y alinear.

---

## 5. Tipos de retorno inválidos en controladores (`Response` / `RedirectResponse` sin importar)

Muchos métodos tienen `@return Response` o `@return RedirectResponse` **sin el `use` correspondiente**, entonces PHPStan los interpreta como `App\Http\Controllers\Response` (que no existe). En otros casos dice `RedirectResponse` pero el método devuelve una vista.

**Corrección general:**
- Si devuelve `view(...)` → `@return \Illuminate\Contracts\View\View`
- Si devuelve `redirect()` / `back()` → `@return \Illuminate\Http\RedirectResponse`
- Si devuelve `response()->json()` → `@return \Illuminate\Http\JsonResponse`
- Si devuelve una descarga de Excel → `@return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse`

### [app/Http/Controllers/EmpleosController.php](../app/Http/Controllers/EmpleosController.php)

| Línea | Qué revisar |
|---|---|
| 49-51 | `showForm()`: `@return Response` → `View` |
| 66 | `export()`: `@param validacionEmprendimiento $request` pero el parámetro real es `Request`. Corregir el PHPDoc. `@return` → `BinaryFileResponse|RedirectResponse` (líneas 159, 162) |
| 86, 105, 109, 135, 142, 146 | `$request->ciudad`, `->edad`, `->created_at`, `->cud`, `->dni`, `->nombre`: falsos positivos (Larastan). Alternativa más prolija: `$request->input('ciudad')`. |

### [app/Http/Controllers/EmprendedorController.php](../app/Http/Controllers/EmprendedorController.php)

| Línea | Qué revisar |
|---|---|
| 6, 57, 157 | `App\Models\categoria` → `App\Models\Categoria` (ver sección 7) |
| 58, 160, 223 | `showForm()`, `emprendedores()`, `showFormCrearEmprendimiento()`: dicen `RedirectResponse` pero devuelven vista |
| 76 | `export()`: `@param validacionSolicitantes` no coincide con `Request`; `@return` → `BinaryFileResponse|RedirectResponse` (líneas 135, 138) |
| 90, 99, 104, 109 | `$request->ciudad`, etc.: falsos positivos (Larastan) |
| 175-182 | `filterEmprendimientosByName()`: `@return` → `JsonResponse` |
| 196-209 | `showEmprendimientoId()`: `@return` → `View|RedirectResponse` |
| 198 | `is_numeric()` sobre un `int` siempre es verdadero. Revisar si el parámetro tiene tipo `int` declarado: en ese caso la validación sobra. |

### [app/Http/Controllers/FormSerParteController.php](../app/Http/Controllers/FormSerParteController.php)

| Línea | Qué revisar |
|---|---|
| 39 | `formarparte()`: dice `RedirectResponse`, devuelve vista |
| 56, 59, 72, 121, 124 | `enviar()`: `@return Response` → `RedirectResponse` |
| 64, 77-94 | `$request->subconjuntos`, `->first_name`, `->email`… (18 propiedades): falsos positivos (Larastan) |

### [app/Http/Controllers/HomeController.php](../app/Http/Controllers/HomeController.php)

| Línea | Qué revisar |
|---|---|
| 35-38 | `index()`: `@return Response` → `View` |

### [app/Http/Controllers/ProgramasController.php](../app/Http/Controllers/ProgramasController.php)

| Línea | Qué revisar |
|---|---|
| 28 | `@return Response, devuelve...` → quitar la coma (ver sección 6) |

### [app/Http/Controllers/noticiasController.php](../app/Http/Controllers/noticiasController.php)

| Línea | Qué revisar |
|---|---|
| 33 | `showNoticias()`: dice `RedirectResponse`, devuelve vista |
| 34 | `perPage()`: se arregla corrigiendo el `@return` de `Noticias::getUltimasNoticias()` (sección 3.5) |
| 49 | `showNoticia()`: dice `RedirectResponse`, devuelve vista |
| 73, 91, 108, 124 | PHPDoc con coma después del tipo (sección 6) |

### [app/Http/Controllers/administradorController.php](../app/Http/Controllers/administradorController.php)

| Línea | Qué revisar |
|---|---|
| 11, 15, 18 | `use App\Models\user`, `redes`, `categoria` → mayúsculas correctas (sección 7) |
| 138, 250 | `@param $request` documentado pero el método no tiene ese parámetro. Borrar la línea del PHPDoc. |
| 141, 260 | `showFormCrearEmprendimiento()`, `showFormEditarEmprendimiento()`: dicen `RedirectResponse`, devuelven vista |
| 160-179 | `$request->instagram`, `->facebook`, etc.: falsos positivos (Larastan) |
| 192, 195, 206 | `$emprendimiento->id`, `->horarios()`, `->imagenes()` sobre `Builder|Model`: falsos positivos (Larastan) |
| 202, 332, 345, 484, 670, 671, 743 | `Cloudinary::upload()` / `uploadApi()` no encontrados: falsos positivos de facade. Si siguen con Larastan, agregar un `@method` al facade o usar `cloudinary()->upload()`. |
| 219 | `&&` con lado derecho siempre verdadero: la condición sobra, revisar. |
| 301, 530, 543, 612, 646 | PHPDoc con coma después del tipo (sección 6) |
| 320, 396-420 | Propiedades de `Emprendedor` sobre `find()`: falsos positivos (Larastan) |
| 373 | `Auth::user()->hasRole()`: falso positivo (Larastan + Spatie). |
| 391, 446, 453, 460 | `editarEmprendimiento()`: `RedirectResponse` sin `use` → agregar `use Illuminate\Http\RedirectResponse;` al inicio del archivo. El `@param Request` no coincide con `validacionEditarEmprendimiento`. |
| 422 | `$request->horarios`: falso positivo |
| 473-517 | `eliminarEmprendimiento()`: ver **sección 3.3** (bug real) |
| 563-602 | `createNoticia()`: mismo `use RedirectResponse` faltante; `@param` incorrecto |
| 589 | `$request->descripcion`: falso positivo |
| 591, 752 | `&&` con lado izquierdo siempre verdadero: revisar la condición |
| 617 | `is_numeric()` sobre `int`: sobra |
| 668-670 | `$noticia->imagen_public_id`: falso positivo |
| 705-724 | `editNoticia()`: mismo patrón (`use`, `@param`) |
| 738-770 | `deleteNoticia()`: mismo patrón |

> **Arreglo rápido para casi todo este archivo:** agregar arriba
> `use Illuminate\Http\RedirectResponse;` y `use Illuminate\Contracts\View\View;`.

---

## 6. PHPDoc mal escrito (79 errores `phpDoc.parseError`)

Son dos errores de formato que se repiten en todos los modelos y varios controladores.

### 6.1 `@property` sin tipo

```php
// ❌ Incorrecto
 * @property $id
 * @property $img_id , Identificador unico de la imagen

// ✅ Correcto
 * @property int $id
 * @property int $img_id Identificador único de la imagen
```

| Archivo | Líneas |
|---|---|
| [app/Models/Empleo.php](../app/Models/Empleo.php) | 17-38 |
| [app/Models/Emprendedor.php](../app/Models/Emprendedor.php) | 21-28 |
| [app/Models/Imagenes.php](../app/Models/Imagenes.php) | 15-20 |
| [app/Models/Noticias.php](../app/Models/Noticias.php) | 17-23 |
| [app/Models/User.php](../app/Models/User.php) | 16-21 |
| [app/Models/redes.php](../app/Models/redes.php) | 14-20 |

Tipos sugeridos: `int` para ids, `string` para textos, `\Carbon\Carbon|null` para `created_at` / `updated_at`, `bool` para booleanos.

### 6.2 Coma entre el tipo y la descripción

```php
// ❌ Incorrecto
 * @return Response , devuelve la interfaz de la seccion de programas.
 * @param int id, ID único del emprendimiento.

// ✅ Correcto
 * @return \Illuminate\Contracts\View\View Devuelve la interfaz de la sección de programas.
 * @param int $id ID único del emprendimiento.
```

| Archivo | Líneas |
|---|---|
| [app/Http/Controllers/ProgramasController.php](../app/Http/Controllers/ProgramasController.php) | 28 |
| [app/Http/Controllers/administradorController.php](../app/Http/Controllers/administradorController.php) | 301, 530, 543, 612, 646 |
| [app/Http/Controllers/noticiasController.php](../app/Http/Controllers/noticiasController.php) | 73, 91, 108, 124 |
| [app/Models/Emprendedor.php](../app/Models/Emprendedor.php) | 140, 205 (`int id` → `int $id`) |
| [app/Models/Horario.php](../app/Models/Horario.php) | 92, 104, 117, 130, 132 |
| [app/Models/Noticias.php](../app/Models/Noticias.php) | 109 |
| [app/Models/direccion.php](../app/Models/direccion.php) | 59, 78, 89 |
| [app/Models/redes.php](../app/Models/redes.php) | 54, 78, 95 |

> Nota: Doxygen (el proyecto tiene `Doxyfile`) también acepta el formato correcto, así que la documentación generada no se rompe.

### 6.3 `$fillable` documentado como `array` / `mixed`

`property.phpDocType` en: [Empleo.php:59](../app/Models/Empleo.php#L59), [Emprendedor.php:50](../app/Models/Emprendedor.php#L50), [Horario.php:37](../app/Models/Horario.php#L37), [Imagenes.php:38](../app/Models/Imagenes.php#L38), [Noticias.php:40](../app/Models/Noticias.php#L40), [User.php:36](../app/Models/User.php#L36), [categoria.php:32](../app/Models/categoria.php#L32), [direccion.php:36](../app/Models/direccion.php#L36), [redes.php:31](../app/Models/redes.php#L31).

```php
/** @var array<int, string> */
protected $fillable = [...];
```

### 6.4 Otros PHPDoc

| Archivo | Línea | Qué revisar |
|---|---|---|
| [app/Models/User.php](../app/Models/User.php) | 26 | `@mixin HasFactory`: `HasFactory` es un trait, no puede ir en `@mixin`. Borrar la línea. |
| [app/Providers/RouteServiceProvider.php](../app/Providers/RouteServiceProvider.php) | 36 | `@var` encima de un método no tiene efecto. Cambiar por `@return void` o borrar. |
| [app/View/Components/AppLayout.php](../app/View/Components/AppLayout.php) | 16 | `@return \Illuminate\View\View` → `\Illuminate\Contracts\View\View` |
| [app/View/Components/GuestLayout.php](../app/View/Components/GuestLayout.php) | 16 | Igual que el anterior |

---

## 7. Nombres de clase con mayúsculas/minúsculas incorrectas (32 errores `class.nameCase`)

En Windows (Laragon) funciona porque el sistema de archivos no distingue mayúsculas, pero **en un servidor Linux falla** (autoload PSR-4). Hay que unificar.

| Nombre real de la clase | Archivo actual | Se usa como | Dónde |
|---|---|---|---|
| `Categoria` | `app/Models/categoria.php` | `categoria` | [EmprendedorController.php](../app/Http/Controllers/EmprendedorController.php) 6, 57, 157 · [administradorController.php](../app/Http/Controllers/administradorController.php) 18, 140, 257 · [Emprendedor.php](../app/Models/Emprendedor.php) 14, 112 · [categoria.php](../app/Models/categoria.php) 57 |
| `Redes` | `app/Models/redes.php` | `redes` | [administradorController.php](../app/Http/Controllers/administradorController.php) 15, 159, 396, 437, 477, 495 · [Emprendedor.php](../app/Models/Emprendedor.php) 67 · [redes.php](../app/Models/redes.php) 105 |
| `direccion` | `app/Models/direccion.php` | `Direccion` | [EmprendedorFactory.php](../database/factories/EmprendedorFactory.php) 7, 23 · [emprendedoresTest.php](../tests/Feature/emprendedoresTest.php) 17, 152 |
| `User` | `app/Models/User.php` | `user` | [administradorController.php](../app/Http/Controllers/administradorController.php) 11 |
| `ImagenesFactory` | — | `imagenesFactory` | [Emprendedor.php](../app/Models/Emprendedor.php) 9 · [Imagenes.php](../app/Models/Imagenes.php) 7, 34 |
| `BelongsTo` / `HasMany` / `HasOne` | (Laravel) | `belongsTo` / `hasMany` / `hasOne` | [Emprendedor.php](../app/Models/Emprendedor.php) 65, 76, 86, 98, 110 · [Imagenes.php](../app/Models/Imagenes.php) 54 · [redes.php](../app/Models/redes.php) 43 |

**Recomendación:** renombrar los archivos a PascalCase (`Categoria.php`, `Redes.php`, `Direccion.php`) y la clase `direccion` → `Direccion`, y después actualizar todas las referencias. En Windows, para que git registre el cambio de mayúsculas: `git mv app/Models/categoria.php app/Models/Categoria.php`.

---

## 8. Tests (38 errores)

| Archivo | Líneas | Qué revisar |
|---|---|---|
| [tests/Feature/emprendedoresExcelTest.php](../tests/Feature/emprendedoresExcelTest.php) | 23, 68 | `assignRole()` / `->id` sobre `factory()->create()`: falso positivo (Larastan) |
| | 54 | `assertTrue(true)`: el test no comprueba nada. Reemplazar por una aserción real. |
| [tests/Feature/emprendedoresTest.php](../tests/Feature/emprendedoresTest.php) | 17, 152 | `Direccion` → mayúsculas (sección 7) |
| | 30, 41, 71, 106, 155-157, 170, 181-183, 219, 232, 249, 273 | Falsos positivos de factory (Larastan) |
| [tests/Feature/loginTest.php](../tests/Feature/loginTest.php) | 17, 30, 38, 73 | Falsos positivos (Larastan) |
| [tests/Feature/noticiasTest.php](../tests/Feature/noticiasTest.php) | 26, 45, 158, 218, 231, 245, 264, 266, 291, 301 | Falsos positivos (Larastan) |
| [tests/Feature/serParteTest.php](../tests/Feature/serParteTest.php) | 112 | "Named arguments" requiere PHP 8: se arregla con `phpVersion` en la config (sección 2.2) |
| [tests/Feature/solicitantesTest.php](../tests/Feature/solicitantesTest.php) | 20 | Falso positivo (Larastan) |
| | 52 | `assertTrue(true)`: test vacío |
| [tests/Unit/ExampleTest.php](../tests/Unit/ExampleTest.php) | 17 | `assertTrue(true)`: test de ejemplo de Laravel, se puede borrar |

---

## 9. Database y otros

| Archivo | Línea | Qué revisar |
|---|---|---|
| [database/seeders/DatabaseSeeder.php](../database/seeders/DatabaseSeeder.php) | 38, 40 | `$emprendedor->categoria`, `->categoria_id`: falsos positivos (Larastan, o al corregir `@property` de `Emprendedor`) |
| [database/seeders/UserSeeder.php](../database/seeders/UserSeeder.php) | 21, 23, 31 | `firstOrCreate()`: falsos positivos (Larastan) |
| [routes/console.php](../routes/console.php) | 18 | `$this` dentro del closure de `Artisan::command()`: es código estándar de Laravel; falso positivo (Larastan lo entiende) |

---

## 10. Orden de trabajo sugerido

1. [x] **Configuración** (sección 2): Larastan + `phpstan.neon` + volver a correr el análisis. (622 → 287 errores)
2. [x] **Bugs reales** (sección 3): primero el `assignRole('admin')` del login y `eliminarEmprendimiento()`. (287 → 252 errores)
3. [x] **Borrar** `routes/auth.php` y revisar `config/permission.php` (sección 4). (Se quitó la clave `team_resolver`, que Spatie 5.11 no usa.)
4. [ ] **Mayúsculas de clases** (sección 7): esto evita errores al subir a un servidor Linux.
5. [ ] **Tipos de retorno** de controladores (sección 5).
6. [ ] **PHPDoc** de modelos y controladores (sección 6).
7. [ ] **Tests** con `assertTrue(true)` (sección 8).
8. [ ] Volver a correr `php vendor/bin/phpstan analyse` y repetir hasta llegar a 0 en nivel 5.
