<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\Cast\String_;

class sendContactForm extends Mailable
{


    use Queueable, SerializesModels;


    /**
       @var string
     */
    public string  $first_name;
    public string  $email;
    public int $tel;
    public string  $description;


    /**
     * Create a new message instance.
     * @param string $first_name
     * @param string $email
     * @param int $tel
     * @param string $description

     * @return void
     */
    public function __construct(string $first_name, string $email, int $tel, string $description)
    {

        $this->first_name = $first_name;
        $this->email = $email;
        $this->tel = $tel;
        $this->description = $description;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject("Formulario de contacto - " . config("app.name"));
        $this->markdown("emails.contact");
    }
}
