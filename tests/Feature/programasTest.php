<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Emprendedor;
use Illuminate\Support\Facades\File;

class programasTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_programas(){
        Emprendedor::factory()->count(10)->create();
        $response = $this->get("/programas");
        $response->assertStatus(200);
        $response->assertViewHas('ultimos'); //Verifica que la vista recibió una variable llamada $ultimos
        $ultimos = $response->viewData('ultimos');
        $this->assertCount(6, $ultimos);
    }
}
