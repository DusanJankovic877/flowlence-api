<?php

namespace App\Mail;

use App\Models\CheckedServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntrepreneurContact extends Mailable
{
    use Queueable, SerializesModels;
    // public $checkedServicesArr = [];
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       

        
      
        return $this->from(request('email'))->markdown('emails.entrepreneurContact');
    }
}
