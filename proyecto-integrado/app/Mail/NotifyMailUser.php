<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMailUser extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($peticion)
    {
	$this->datos['name'] = $peticion->name;
        $this->datos['email'] = $peticion->email;
        $this->datos['state'] = $peticion->statesRelation->state;
        $this->datos['updated_at'] = $peticion->updated_at;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('components.email-state-user');

    }
}
