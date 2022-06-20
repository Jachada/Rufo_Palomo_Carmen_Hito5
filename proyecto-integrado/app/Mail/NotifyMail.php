<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $datos;
    public $peticion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($peticion)
    {
        $this->peticion = $peticion;
        if ($peticion->comment) {
            $this->datos['issue'] = $peticion->issueRelation->title;
            $this->datos['author'] = $peticion->userRelation->name;
            $this->datos['comment'] = $peticion->comment;
            $this->datos['created_at'] = $peticion->created_at;
        } else if ($peticion->created_at == $peticion->updated_at) {
            $this->datos['title'] = $peticion->title;
            $this->datos['description'] = $peticion->description;
            $this->datos['classroom'] = $peticion->classroomRelation->class;
            $this->datos['created_at'] = $peticion->created_at;
        } else {
            $this->datos['title'] = $peticion->title;
            $this->datos['description'] = $peticion->description;
            $this->datos['classroom'] = $peticion->classroomRelation->class;
            $this->datos['condition'] = $peticion->conditionRelation->condition;
            $this->datos['updated_at'] = $peticion->updated_at;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->peticion->comment) {
            return $this->view('components.email-comment');
        } else if ($this->peticion->created_at == $this->peticion->updated_at) {
            return $this->view('components.email-create-issue');
        } else {
            return $this->view('components.email-edit-issue');
        }
    }
}
