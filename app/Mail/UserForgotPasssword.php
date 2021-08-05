<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserForgotPasssword extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $link;
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
        return $this->from('tt35093@gmail.com', 'Questions for Her')
            ->subject('Forgot Password link')
            ->view('email.user-email-forgot')
            ->with([
                'link'   => $this->link,
                'user'   => $this->user,
               'logo'   => url("public/assets/img/meredith-logo.png")
            ]);
    }
}
