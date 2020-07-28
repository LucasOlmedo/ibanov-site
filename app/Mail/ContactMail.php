<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ContactMail
 * @package App\Mail
 */
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $mailFrom;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $messageMail;

    /**
     * Create a new message instance.
     *
     * @param  string  $name
     * @param  string  $mailFrom
     * @param  string  $subject
     * @param  string  $messageMail
     */
    public function __construct(string $name, string $mailFrom, string $subject, string $messageMail)
    {
        $this->name = $name;
        $this->mailFrom = env('MAIL_USERNAME', $mailFrom);
        $this->subject = $subject;
        $this->messageMail = $messageMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mailFrom, $this->name)
            ->cc($this->mailFrom)
            ->subject($this->subject)
            ->view('mail.contact');
    }
}
