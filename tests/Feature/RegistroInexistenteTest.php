<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Punto 3.6: editar las imágenes de un emprendimiento o noticia que no existe
 * daba error 500 (find() sin chequeo de null); ahora responde 404.
 */
class RegistroInexistenteTest extends TestCase
{
    use RefreshDatabase;

    private function crearAdmin(string $permiso): User
    {
        $rol = Role::create(['name' => 'admin']);
        Permission::create(['name' => $permiso]);
        $rol->givePermissionTo($permiso);
        /** @var User $user */
        $user = User::factory()->create();
        $user->assignRole('admin');
        return $user;
    }

    public function test_editar_imagenes_de_un_emprendimiento_inexistente_da_404()
    {
        $response = $this->actingAs($this->crearAdmin('editar emprendimiento'))
            ->post('/emprendedores/editarImgs/999999', [
                'imagenes' => [UploadedFile::fake()->image('foto.jpg', 100, 100)],
            ]);

        $response->assertNotFound();
    }

    public function test_editar_imagen_de_una_noticia_inexistente_da_404()
    {
        $response = $this->actingAs($this->crearAdmin('editar noticia'))
            ->post('/noticias/editarImgs/999999', [
                'imagen' => UploadedFile::fake()->image('foto.jpg', 100, 100),
            ]);

        $response->assertNotFound();
    }
}
