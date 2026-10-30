<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Los JS se sirven con caché de 10 años, así que las vistas los piden con ?v=<fecha de modificación>
 * para que cada despliegue fuerce a navegador y Cloudflare a bajar la versión nueva.
 */
class VersionadoJsTest extends TestCase
{
    use RefreshDatabase;

    private function srcVersionado(string $ruta): string
    {
        return asset($ruta) . '?v=' . filemtime(public_path($ruta));
    }

    public function test_emprendedores_pide_el_js_versionado()
    {
        $this->get('/emprendedores')
            ->assertStatus(200)
            ->assertSee($this->srcVersionado('js/emprendedores/emprendedores.js'), false);
    }

    public function test_paginas_de_reset_piden_app_js_y_app_css_versionados()
    {
        $this->get('/password/reset')
            ->assertStatus(200)
            ->assertSee($this->srcVersionado('js/app.js'), false)
            ->assertSee($this->srcVersionado('css/app.css'), false);
    }

    public function test_noticias_pide_el_js_versionado()
    {
        $this->get('/noticias')
            ->assertStatus(200)
            ->assertSee($this->srcVersionado('js/noticias/buscarNoticias.js'), false);
    }
}
