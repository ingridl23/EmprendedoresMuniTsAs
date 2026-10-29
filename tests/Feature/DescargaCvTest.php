<?php

namespace Tests\Feature;

use App\Models\Empleo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DescargaCvTest extends TestCase
{
    use RefreshDatabase;

    private function crearEmpleoConCv(): Empleo
    {
        Storage::fake('local');
        Storage::disk('local')->put('cvs/abc123.pdf', '%PDF-1.4 contenido de prueba');
        /** @var Empleo $empleo */
        $empleo = Empleo::factory()->create(['cv_path' => 'cvs/abc123.pdf']);
        return $empleo;
    }

    private function crearAdmin(bool $conPermiso): User
    {
        $rol = Role::create(['name' => 'admin']);
        if ($conPermiso) {
            Permission::create(['name' => 'filtrar datos']);
            $rol->givePermissionTo('filtrar datos');
        }
        /** @var User $user */
        $user = User::factory()->create();
        $user->assignRole('admin');
        return $user;
    }

    public function test_sin_sesion_redirige_al_login()
    {
        $empleo = $this->crearEmpleoConCv();

        $this->get("/solicitantes/{$empleo->id}/cv")->assertRedirect(route('showlogin'));
    }

    public function test_sin_permiso_no_puede_descargar()
    {
        $empleo = $this->crearEmpleoConCv();

        $this->actingAs($this->crearAdmin(false))
            ->get("/solicitantes/{$empleo->id}/cv")
            ->assertStatus(403);
    }

    public function test_con_permiso_descarga_el_cv()
    {
        $empleo = $this->crearEmpleoConCv();

        $response = $this->actingAs($this->crearAdmin(true))->get("/solicitantes/{$empleo->id}/cv");

        $response->assertStatus(200);
        $response->assertDownload("cv-solicitante-{$empleo->id}.pdf");
    }

    public function test_solicitante_sin_cv_da_404()
    {
        Storage::fake('local');
        /** @var Empleo $empleo */
        $empleo = Empleo::factory()->create(['cv_path' => null]);

        $this->actingAs($this->crearAdmin(true))
            ->get("/solicitantes/{$empleo->id}/cv")
            ->assertStatus(404);
    }

    public function test_cv_en_disco_publico_no_se_sirve_por_esta_ruta()
    {
        Storage::fake('local');
        Storage::fake('public');
        Storage::disk('public')->put('cvs/viejo.pdf', '%PDF-1.4');
        /** @var Empleo $empleo */
        $empleo = Empleo::factory()->create(['cv_path' => 'cvs/viejo.pdf']);

        $this->actingAs($this->crearAdmin(true))
            ->get("/solicitantes/{$empleo->id}/cv")
            ->assertStatus(404);
    }
}
