<?php

namespace Tests\Feature;

use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Requests\validacionEmprendimiento;
use App\Http\Requests\validacionNoticia;
use App\Models\Emprendedor;
use App\Models\Noticias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Punto 2.5 de la migración: validación de búsquedas, imágenes y horarios.
 */
class ValidacionEntradasTest extends TestCase
{
    use RefreshDatabase;

    private const BUSCADORES = [
        '/emprendedores/buscador',
        '/noticias/buscadorTitulo',
        '/noticias/buscadorCategoria',
        '/noticias/buscadorFecha',
    ];

    private function crearNoticia(string $titulo): void
    {
        // Sin factory: NoticiasFactory descarga una imagen de internet
        Noticias::create([
            'titulo' => $titulo,
            'categoria' => 'Evento',
            'descripcion' => 'Descripcion de prueba',
            'imagen' => 'img/prueba.jpg',
            'imagen_public_id' => '123',
        ]);
    }

    // ---------- Búsquedas ----------

    public function test_busqueda_de_mas_de_100_caracteres_se_rechaza()
    {
        $larga = str_repeat('a', 101);
        foreach (self::BUSCADORES as $ruta) {
            $this->get("{$ruta}?busqueda={$larga}")->assertStatus(422)->assertExactJson([]);
        }
    }

    public function test_busqueda_de_100_caracteres_se_acepta()
    {
        $limite = str_repeat('a', 100);
        foreach (self::BUSCADORES as $ruta) {
            $this->get("{$ruta}?busqueda={$limite}")->assertStatus(200);
        }
    }

    public function test_comodines_se_buscan_como_texto_y_no_devuelven_todo()
    {
        Emprendedor::factory()->create(['nombre' => 'Panaderia Don Jose']);
        $this->crearNoticia('Feria de empleo');

        foreach (['%', '_'] as $comodin) {
            $q = urlencode($comodin);
            $this->get("/emprendedores/buscador?busqueda={$q}")->assertStatus(200)->assertJsonCount(0);
            $this->get("/noticias/buscadorTitulo?busqueda={$q}")->assertStatus(200)->assertJsonCount(0);
        }
    }

    public function test_busqueda_normal_sigue_funcionando()
    {
        Emprendedor::factory()->create(['nombre' => 'Panaderia Don Jose']);
        Emprendedor::factory()->create(['nombre' => 'Herreria El Yunque']);
        $this->crearNoticia('Feria de empleo');

        $this->get('/emprendedores/buscador?busqueda=panad')->assertJsonCount(1)->assertJsonFragment(['nombre' => 'Panaderia Don Jose']);
        $this->get('/noticias/buscadorTitulo?busqueda=Feria')->assertJsonCount(1);
        $this->get('/noticias/buscadorCategoria?busqueda=Evento')->assertJsonCount(1);
        $this->get('/noticias/buscadorFecha?busqueda=' . now()->format('Y-m-d'))->assertJsonCount(1);
    }

    public function test_texto_con_comodin_en_el_medio_se_encuentra_literal()
    {
        Emprendedor::factory()->create(['nombre' => '100% Natural']);
        Emprendedor::factory()->create(['nombre' => '1000 Natural']);

        $this->get('/emprendedores/buscador?busqueda=' . urlencode('100%'))
            ->assertJsonCount(1)
            ->assertJsonFragment(['nombre' => '100% Natural']);
    }

    // ---------- Imágenes ----------

    private function reglaImagenEmprendimiento(): array
    {
        return ['imagenes.*' => (new validacionEmprendimiento())->rules()['imagenes.*']];
    }

    public function test_svg_no_se_acepta_en_emprendimientos()
    {
        $svg = UploadedFile::fake()->createWithContent('logo.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>');

        foreach ([new validacionEmprendimiento(), new validacionEditarEmprendimiento()] as $request) {
            $v = Validator::make(['imagenes' => [$svg]], ['imagenes.*' => $request->rules()['imagenes.*']]);
            $this->assertTrue($v->fails(), get_class($request) . ' acepta SVG');
        }
    }

    public function test_jpg_se_sigue_aceptando_en_emprendimientos()
    {
        $jpg = UploadedFile::fake()->image('foto.jpg', 800, 600);

        $this->assertFalse(Validator::make(['imagenes' => [$jpg]], $this->reglaImagenEmprendimiento())->fails());
    }

    public function test_imagen_de_noticia_de_mas_de_2mb_se_rechaza()
    {
        $grande = UploadedFile::fake()->image('foto.jpg')->size(2049);
        $chica = UploadedFile::fake()->image('foto.jpg')->size(2048);
        $regla = ['imagen' => (new validacionNoticia())->rules()['imagen']];

        $this->assertTrue(Validator::make(['imagen' => $grande], $regla)->fails());
        $this->assertFalse(Validator::make(['imagen' => $chica], $regla)->fails());
    }

    // ---------- Horarios ----------

    private function validarHorarios(array $datos): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($datos, validacionEmprendimiento::reglasHorarios());
    }

    public function test_horarios_validos_se_aceptan()
    {
        $v = $this->validarHorarios(['horarios' => [
            'Lunes' => ['hora_de_apertura' => '08:00', 'hora_de_cierre' => '18:30'],
            'Martes' => ['hora_de_apertura' => '08:00:00', 'hora_de_cierre' => '18:30:00'], // así vienen al editar
            'Domingo' => ['hora_de_apertura' => '', 'hora_de_cierre' => '', 'cerrado' => '1'],
        ]]);

        $this->assertFalse($v->fails(), json_encode($v->errors()->toArray()));
    }

    public function test_horarios_faltantes_se_rechazan()
    {
        $this->assertTrue($this->validarHorarios([])->fails());
        $this->assertTrue($this->validarHorarios(['horarios' => 'texto'])->fails());
    }

    public function test_dia_inexistente_se_rechaza()
    {
        $v = $this->validarHorarios(['horarios' => ['Feriado' => ['hora_de_apertura' => '08:00']]]);

        $this->assertTrue($v->fails());
    }

    public function test_hora_invalida_se_rechaza()
    {
        foreach (['25:00', '8am', '08:60', '<script>'] as $hora) {
            $v = $this->validarHorarios(['horarios' => ['Lunes' => ['hora_de_apertura' => $hora]]]);
            $this->assertTrue($v->fails(), "acepta la hora {$hora}");
        }
    }
}
