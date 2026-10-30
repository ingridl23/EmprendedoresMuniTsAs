<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Punto 2.6: CORS de /api/* restringido al dominio propio.
 */
class CorsTest extends TestCase
{
    public function test_origen_ajeno_no_recibe_permiso_cors()
    {
        $response = $this->withHeaders(['Origin' => 'https://sitio-ajeno.com'])->getJson('/api/user');

        $this->assertNotSame('*', $response->headers->get('Access-Control-Allow-Origin'));
        $this->assertNotSame('https://sitio-ajeno.com', $response->headers->get('Access-Control-Allow-Origin'));
    }

    public function test_el_sitio_propio_si_recibe_permiso_cors()
    {
        $response = $this->withHeaders(['Origin' => 'https://emprendedores.tresarroyos.gov.ar'])->getJson('/api/user');

        $response->assertHeader('Access-Control-Allow-Origin', 'https://emprendedores.tresarroyos.gov.ar');
    }
}
