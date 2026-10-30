<?php

namespace Tests\Feature;

use App\Models\Emprendedor;
use App\Models\Horario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Punto 2.11: al crear un emprendimiento solo se guardan los días con datos, pero el formulario
 * de edición manda los 7 días. Editar no debe fallar por los días que no existen en la base.
 */
class EditarHorariosTest extends TestCase
{
    use RefreshDatabase;

    private const DIAS = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

    private function crearAdmin(): User
    {
        $rol = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'editar emprendimiento']);
        $rol->givePermissionTo('editar emprendimiento');
        /** @var User $user */
        $user = User::factory()->create();
        $user->assignRole('admin');
        return $user;
    }

    /** Emprendimiento con solo el lunes cargado, como queda al crearlo cargando un único día. */
    private function crearEmprendimientoConSoloLunes(): Emprendedor
    {
        /** @var Emprendedor $emprendimiento */
        $emprendimiento = Emprendedor::factory()->create();
        Horario::create([
            'dia' => 'Lunes', 'hora_apertura' => '08:00', 'hora_cierre' => '12:00',
            'participa_feria' => 0, 'cerrado' => 0, 'emprendedor_id' => $emprendimiento->id,
        ]);
        return $emprendimiento;
    }

    /** Lo que manda el formulario de edición: los 7 días, vacíos salvo los indicados. */
    private function horariosDelFormulario(array $cargados): array
    {
        $horarios = [];
        foreach (self::DIAS as $dia) {
            $horarios[$dia] = $cargados[$dia] ?? ['hora_de_apertura' => '', 'hora_de_cierre' => ''];
        }
        return $horarios;
    }

    private function editar(Emprendedor $emprendimiento, array $horarios)
    {
        return $this->actingAs($this->crearAdmin())->patch("/emprendedores/{$emprendimiento->id}", [
            'nombre' => 'Nombre editado',
            'descripcion' => 'Descripcion de prueba editada',
            'categoria' => $emprendimiento->categoria_id,
            'whatsapp' => '123456789',
            'ciudad' => 'Tres Arroyos',
            'localidad' => 'Centro',
            'calle' => 'Calle',
            'altura' => '10',
            'horarios' => $horarios,
        ]);
    }

    public function test_editar_con_dias_que_no_existen_en_la_base_no_falla()
    {
        $emprendimiento = $this->crearEmprendimientoConSoloLunes();

        $response = $this->editar($emprendimiento, $this->horariosDelFormulario([]));

        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('success');
        $this->assertSame('Nombre editado', $emprendimiento->fresh()->nombre);
    }

    public function test_un_dia_nuevo_con_datos_se_crea()
    {
        $emprendimiento = $this->crearEmprendimientoConSoloLunes();

        $this->editar($emprendimiento, $this->horariosDelFormulario([
            'Martes' => ['hora_de_apertura' => '09:00', 'hora_de_cierre' => '13:00', 'participa_feria' => '1'],
        ]));

        $martes = Horario::where('emprendedor_id', $emprendimiento->id)->where('dia', 'Martes')->first();
        $this->assertNotNull($martes);
        $this->assertSame('09:00:00', $martes->hora_apertura);
        $this->assertSame('13:00:00', $martes->hora_cierre);
        $this->assertEquals(1, $martes->participa_feria);
    }

    public function test_un_dia_nuevo_marcado_como_cerrado_se_crea()
    {
        $emprendimiento = $this->crearEmprendimientoConSoloLunes();

        $this->editar($emprendimiento, $this->horariosDelFormulario([
            'Domingo' => ['hora_de_apertura' => '', 'hora_de_cierre' => '', 'cerrado' => '1'],
        ]));

        $domingo = Horario::where('emprendedor_id', $emprendimiento->id)->where('dia', 'Domingo')->first();
        $this->assertNotNull($domingo);
        $this->assertEquals(1, $domingo->cerrado);
    }

    public function test_los_dias_vacios_no_se_crean()
    {
        $emprendimiento = $this->crearEmprendimientoConSoloLunes();

        $this->editar($emprendimiento, $this->horariosDelFormulario([
            'Lunes' => ['hora_de_apertura' => '08:00', 'hora_de_cierre' => '12:00'],
        ]));

        $this->assertSame(['Lunes'], Horario::where('emprendedor_id', $emprendimiento->id)->pluck('dia')->all());
    }

    public function test_un_dia_existente_se_actualiza()
    {
        $emprendimiento = $this->crearEmprendimientoConSoloLunes();

        $this->editar($emprendimiento, $this->horariosDelFormulario([
            'Lunes' => ['hora_de_apertura' => '10:00', 'hora_de_cierre' => '18:00'],
        ]));

        $lunes = Horario::where('emprendedor_id', $emprendimiento->id)->where('dia', 'Lunes')->firstOrFail();
        $this->assertSame('10:00:00', $lunes->hora_apertura);
        $this->assertSame('18:00:00', $lunes->hora_cierre);
        $this->assertSame(1, Horario::where('emprendedor_id', $emprendimiento->id)->where('dia', 'Lunes')->count());
    }
}
