<?php

namespace App\Services\Site;

use App\Mail\ContactMail;
use Exception;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendMailService
 * @package App\Services\Site
 */
class SendMailService
{
    /**
     * @param  array  $mailArgs
     * @throws Exception
     */
    public function send(array $mailArgs = [])
    {
        try {
            Mail::to('lcsolmedosilva@gmail.com')
                ->send(new ContactMail(...array_values($mailArgs)));
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
