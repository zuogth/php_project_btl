<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$pass)
    {
        $this->email=$email;
        $this->pass=$pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Lấy lại mật khẩu!')
                    ->markdown('emails.forgot',[
                        'password'=>$this->pass
                    ]);
    }
}
