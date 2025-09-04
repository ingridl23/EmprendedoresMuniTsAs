<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Mail\Signedup;
use App\Mail\sendContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class serParteTest extends TestCase
{

    public function test_formulario_empresa_se_envia_correctamente(){
        Mail::fake(); // Evita que realmente se envíe el correo
        $data = [
            'first_name' => 'Juan',
            'email' => 'juan@example.com',
            'asunto' => 'Consulta empresa',
            'tel' => '123456789',
            'description' =>'Breve descripcion de lo que se desea hacer',
            'subconjuntos' => 'empresa',
            'nombre_empresa' => 'Prueba'
        ];

        $response = $this->post('/formulario/enviar', $data);
        $response->assertRedirect(); 
        $response->assertSessionHas('success', 'Formulario enviado correctamente.');
        Mail::assertSent(\App\Mail\sendContactForm::class);
    }



    public function test_formulario_emprendedor_se_envia_correctamente(){
        Mail::fake(); // Evita que realmente se envíe el correo
        $data = [
            'first_name' => 'Juan',
            'email' => 'juan@example.com',
            'asunto' => 'Consulta empresa',
            'tel' => '123456789',
            'description' =>'Breve descripcion de lo que se desea hacer',
            'subconjuntos' => 'emprendedor',
            'club_emprendedor' => 'Si'
        ];

        $response = $this->post('/formulario/enviar', $data);
        $response->assertRedirect(); 
        $response->assertSessionHas('success', 'Formulario enviado correctamente.');
        Mail::assertSent(\App\Mail\sendContactForm::class);
    }



    public function test_formulario_busqueda_de_empleo_se_envia_correctamente(){
        Mail::fake();
        Storage::fake('public'); // Evita que se escriba en disco real
         $cv = UploadedFile::fake()->create('cv.pdf', 100); // Simula un archivo PDF de 100 KB
        $data = [
            'first_name' => 'Juan',
            'email' => 'juan@example.com',
            'asunto' => 'Consulta empresa',
            'tel' => '123456789',
            'description' =>'Breve descripcion de lo que se desea hacer',
            'subconjuntos' => 'busqueda de empleo',
            'edad' => 21,
            'dni' => 25645789,
            'ciudad' => 'Tres Arroyos',
            "localidad" => "Tres Arroyos",
            'formacion' => 'Secundario',
            'referencia_laboral' => 'Aca',
            'referencia_rubro' => 'Acasss',
            'referencia_actividad' => 'ochenta años',
            'contratista' => 'German',
            'referencia_telefonica' => 568974458,
            'cud' => 'Si',
            'dependencia' => 'Si obvio',
            'cv' => $cv,
        ];

        $response = $this->post('/formulario/enviar', $data);
        $response->assertRedirect(); 
        $response->assertSessionHas('success', 'Formulario enviado correctamente.');
        Mail::assertSent(\App\Mail\sendContactForm::class);
    }



    public function test_login_rechazado_por_oculto(){
        Mail::fake();
        $response = $this->post('/login', [
            'first_name' => 'Juan',
            'email' => 'juan@example.com',
            'asunto' => 'Consulta empresa',
            'tel' => '123456789',
            'description' =>'Breve descripcion de lo que se desea hacer',
            'subconjuntos' => 'emprendedor',
            'club_emprendedor' => 'Si',
            'oculto' => 'bot_dato', // Simula bot
        ]);
        $response->assertRedirect();
        Mail::assertNothingSent(); //Asegura que no se haya mandado ningun mail
    }



    public function test_cv_invalido_retorna_error(){
        Mail::fake();
        // Simular un archivo que no es válido
        $fakeCv = new UploadedFile(
            path: '/ruta/falsa/algo.pdf', // Ruta inexistente
            originalName: 'algo.pdf',
            mimeType: 'application/pdf',
            error: UPLOAD_ERR_CANT_WRITE, // fuerza un error
            test: true
        );
        $data = [
            'first_name' => 'Juan',
            'email' => 'juan@example.com',
            'asunto' => 'Consulta',
            'tel' => '123456789',
            'subconjuntos' => 'busqueda de empleo',
            'edad' => 21,
            'dni' => 25645789,
            'ciudad' => 'Tres Arroyos',
            "localidad" => "Tres Arroyos",
            'formacion' => 'Secundario',
            'referencia_laboral' => 'Aca',
            'referencia_rubro' => 'Acasss',
            'referencia_actividad' => 'ochenta años',
            'contratista' => 'German',
            'referencia_telefonica' => 568974458,
            'cud' => 'Si',
            'dependencia' => 'Si obvio',
            'cv' => $fakeCv, 
        ];
        $response = $this->post('/formulario/enviar', $data);
        $response->assertRedirect();
        Mail::assertNothingSent();
    }
    

}
