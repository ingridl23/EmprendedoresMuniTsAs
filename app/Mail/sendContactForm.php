<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendContactForm extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $email = $this->subject($this->data['asunto'] ?? 'Nuevo formulario de contacto')
            ->view('emails.contact')
            ->with('data', $this->data);

        // Si hay un archivo adjunto tipo UploadedFile
        if (isset($this->data['cv']) && $this->data['cv'] instanceof \Illuminate\Http\UploadedFile) {
            $email->attach(
                $this->data['cv']->getRealPath(), // Ruta temporal del archivo
                [
                    'as' => $this->data['cv']->getClientOriginalName(), // Nombre original
                    'mime' => $this->data['cv']->getClientMimeType(),   // Tipo MIME
                ]
            );
        }

        return $email;
    }
}
