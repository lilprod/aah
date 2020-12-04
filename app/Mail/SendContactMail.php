<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $firstname;
    public $phone_number;
    public $email;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $firstname, $phone_number, $email, $subject, $message)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_email = $this->email;
        $e_subject = $this->subject;
        $e_message = $this->message;
        $e_name = $this->name; 
        $e_firstname = $this->firstname; 
        $e_phone = $this->phone_number; 

        return $this->from($e_email)->subject($e_subject)->view('mail.contact_mail', compact('e_name', 'e_firstname', 'e_phone', 'e_email','e_message'));

        //return $this->view('view.name');
    }
}
