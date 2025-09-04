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
use App\Models\Emprendedor;
use App\Models\Categoria;

class emprendedoresExcelTest extends TestCase
{
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
        Emprendedor::factory()->count(10)->create();
        $response = $this->get('/emprendedores/export');
        $response->assertStatus(200);
        Excel::assertDownloaded('emprendedores.xlsx');
    }

    public function test_exporta_sin_resultados(){
        $admin = $this->crearUsuario("descargar excel");
        $this->actingAs($admin);

        Excel::fake();
        $response = $this->get('/emprendedores/export');
        $response->assertStatus(302);

        //Comprueba que no se haya descargado el archivo Excel al no haber coincidencias
        try {
            Excel::assertDownloaded('emprendedores.xlsx');
            $this->fail('El archivo emprendedores.xlsx no debería haberse descargado.');
        } catch (\PHPUnit\Framework\ExpectationFailedException $e) {
            $this->assertTrue(true);
        }
    }

    public function test_exporta_con_algun_filtro(){
        $admin = $this->crearUsuario("descargar excel");
        $this->actingAs($admin);
        $categoria = Categoria::factory()->create([
            "categoria" => 'Indumentaria',
        ]);

        Excel::fake();
        Emprendedor::factory()->create([
            'nombre' => 'Valen',
            'categoria_id' => $categoria->id,
        ]);
        $response = $this->get("/emprendedores/export?nombre=Valen&categoria=1");
        $response->assertStatus(200);
        Excel::assertDownloaded('emprendedores.xlsx');
    }
}
