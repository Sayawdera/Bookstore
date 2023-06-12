<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    protected array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->to($this->data['to'])->subject($this->data['subject'])->markdown('mail.message',$this->data);
    }
}