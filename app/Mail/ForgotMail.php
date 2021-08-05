<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tt35093@gmail.com', 'contact us')
            ->subject('Forgot Password link')
            ->view('email.user-email-forgot')
            ->with([
                'link'   => $this->link,
                'user'   => $this->user,
                 'logo'   => url("public/assets/img/meredith-logo.png")
            ]);
    }
}
