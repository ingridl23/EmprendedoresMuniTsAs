<?php

namespace Tests\Feature;

use App\Http\Controllers\AdministradorController;
use App\Models\Redes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Punto 3.4: armado de las URLs de redes sociales.
 * Antes, `!strpos($url, 'https')` daba true cuando la URL empezaba con https (posición 0)
 * y le volvía a agregar el prefijo; además fallaba con null en PHP 8.1+.
 */
class RedesTest extends TestCase
{
    use RefreshDatabase;

    private function editarRedes(?string $instagram, ?string $facebook): Redes
    {
        /** @var Redes $redes */
        $redes = Redes::factory()->create();
        $redes->instagram = $instagram;
        $redes->facebook = $facebook;
        Redes::editarEmprendimiento($redes);
        return $redes->fresh();
    }

    public function test_un_nombre_de_usuario_se_convierte_en_url()
    {
        $redes = $this->editarRedes('usuario', 'pagina');

        $this->assertSame('https://instagram.com/usuario', $redes->instagram);
        $this->assertSame('https://facebook.com/pagina', $redes->facebook);
    }

    public function test_una_url_completa_no_se_duplica()
    {
        $redes = $this->editarRedes('https://instagram.com/usuario', 'https://facebook.com/pagina');

        $this->assertSame('https://instagram.com/usuario', $redes->instagram);
        $this->assertSame('https://facebook.com/pagina', $redes->facebook);
    }

    public function test_redes_vacias_quedan_vacias()
    {
        $redes = $this->editarRedes(null, null);

        $this->assertNull($redes->instagram);
        $this->assertNull($redes->facebook);
    }

    public function test_obtener_redes_devuelve_el_nombre_de_usuario()
    {
        $controller = new AdministradorController();

        $this->assertSame('usuario', $controller->obtenerRedes('https://instagram.com/usuario'));
        $this->assertSame('usuario', $controller->obtenerRedes('https://instagram.com/usuario/'));
        $this->assertSame('usuario', $controller->obtenerRedes('usuario'));
        $this->assertNull($controller->obtenerRedes(null));
    }
}
