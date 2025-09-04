<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Empleo;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleosExport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class solicitantesTest extends TestCase{
    use RefreshDatabase;

    private function crearUsuario($permission){
        $role1=Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        if($permission != null){
            Permission::create(['name' => $permission]);
            $role1->givePermissionTo($permission);
        }
        return $admin;
    }

    public function test_exporta_con_resultados(){
        $admin = $this->crearUsuario("descargar excel");
        $this->actingAs($admin);

        Excel::fake();
        Empleo::factory()->count(10)->create();
        $response = $this->get('/empleos/export');
        $response->assertStatus(200);
        Excel::assertDownloaded('solicitantes.xlsx');
    }

    public function test_exporta_sin_resultados(){
        $admin = $this->crearUsuario("descargar excel");
        $this->actingAs($admin);

        Excel::fake();
        $response = $this->get('/empleos/export');
        $response->assertStatus(302);

        //Comprueba que no se haya descargado el archivo Excel al no haber coincidencias
        try {
            Excel::assertDownloaded('solicitantes.xlsx');
            $this->fail('El archivo solicitantes.xlsx no debería haberse descargado.');
        } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
            $this->assertTrue(true);
        }
    }

    public function test_exporta_con_algun_filtro(){
        $admin = $this->crearUsuario("descargar excel");
        $this->actingAs($admin);

        Excel::fake();
        Empleo::factory()->create([
            'ciudad' => 'Tres Arroyos',
            'edad' => 20
        ]);
        $response = $this->get('/empleos/export?ciudad=Tres Arroyos&edad=20');
        $response->assertStatus(200);
        Excel::assertDownloaded('solicitantes.xlsx');
    }
}
