<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $link, $logo;

    public function __construct($link, $logo)
    {
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
            ->view('admin.email.reset-link')
            ->with([
                'link'   => $this->link,
                'logo'   => $this->logo
            ]);
    }
}
