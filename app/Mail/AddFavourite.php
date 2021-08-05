<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddFavourite extends Mailable
{
    use Queueable, SerializesModels;
    public $property_owner_name;
    public $interest_user_name;
    // public $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($property_owner_name , $interest_user_name )
    {
        $this->property_owner_name = $property_owner_name;
        $this->interest_user_name = $interest_user_name;
        // $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tt35093@gmail.com', 'Knest')
            ->subject('User Interest')
            ->view('email.knest_user_interest')
            ->with([
                'property_owner_name' =>  $this->property_owner_name,
                'interest_user_name' =>  $this->interest_user_name,
                // 'description' =>  $this->description,
                // 'logo'   => url("public/assets/img/meredith-logo.png")
            ]);
    }
}
