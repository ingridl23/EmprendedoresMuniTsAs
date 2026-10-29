<?php

namespace Tests\Feature;

use App\Models\Emprendedor;
use App\Models\Noticias;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Las descripciones se muestran con nl2br() para respetar los saltos de línea,
 * pero el texto tiene que salir escapado para que no se pueda inyectar HTML/JS (XSS).
 */
class EscapadoDescripcionesTest extends TestCase
{
    use RefreshDatabase;

    private const DESCRIPCION = "Primera linea\n<script>alert('xss')</script>";

    public function test_descripcion_de_noticia_se_muestra_escapada()
    {
        // Se crea sin factory porque NoticiasFactory descarga una imagen de internet
        $noticia = Noticias::create([
            'titulo' => 'Noticia de prueba',
            'categoria' => 'Evento',
            'descripcion' => self::DESCRIPCION,
            'imagen' => 'img/prueba.jpg',
            'imagen_public_id' => '123',
        ]);

        $response = $this->get("/noticias/{$noticia->id}");

        $response->assertStatus(200);
        $response->assertDontSee("<script>alert('xss')</script>", false);
        $response->assertSee('&lt;script&gt;', false);
        $response->assertSee('Primera linea<br />', false);
    }

    public function test_descripcion_de_emprendimiento_se_muestra_escapada()
    {
        Emprendedor::factory()->create(['descripcion' => self::DESCRIPCION]);

        $response = $this->get('/emprendedores');

        $response->assertStatus(200);
        $response->assertDontSee("<script>alert('xss')</script>", false);
        $response->assertSee('&lt;script&gt;', false);
        $response->assertSee('Primera linea<br />', false);
    }
}
