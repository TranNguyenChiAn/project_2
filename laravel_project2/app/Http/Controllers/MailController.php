<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SampleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test mail sent from Laravel.'
        ];

        $name='Tran Dai Nghia';

//        Mail::to('chiantrannguyen@gmail.com')->send(new SampleMail($details));

        Mail::send('emails.sampleMail', compact('name'), function ($email) use($name)
        {
            $email->subject('Demo test mail');
            $email->to('trantranchian@gmail.com', $name);
        });
//        return "Email has been sent!";
    }

}
