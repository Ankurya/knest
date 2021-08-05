<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $link, $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $link, $logo)
    {
        $this->user = $user;
        $this->link = $link;
        $this->logo = $logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tt35093@gmail.com', 'Knest')
            ->subject('Forgot Password link for Knest')
            ->view('user.email.reset-link')
            ->with([
                'link'   => $this->link,
                'user'   => $this->user,
                'logo'   => $this->logo
            ]);
    }
}
