<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user)
    {
        $this->user =  $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')
        ->with('name', 'unai')
        ->from('sistemas@forestpioneer.com', 'FOREST PIONEER SL')
        ->BCC('contabilidad@forestpioneer.com', 'Urki')
        ->subject('Bienvenido a Forest Pioneer SL');
    }
}
