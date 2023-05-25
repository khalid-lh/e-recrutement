<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data=[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
       return $this->from('lahyalkhalid1@gmail.com','LAHYAL KHALID')->subject($this->data['subject'])->view('sendEmailtoRecruteur')->with(['data' => $this->data]);
    }

    public function sendmail()
    {
        
        return $this->from($this->data['emailsender'], 'kayn')
        ->subject($this->data['subject'])
        ->view('sendEmailtoRecruteur')
        ->with('body', $this->data['body']);
    }
}
