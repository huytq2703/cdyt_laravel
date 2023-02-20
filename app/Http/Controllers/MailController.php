<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\AdmissionsOnlineRequest;


class MailController extends Controller
{
    public function test ()
    {
        $content = [
            'content' => 'Trường Cao đẳng Y tế đã gửi thông báo'
        ];
        Mail::to("huytq270397@gmail.com")->send(new SendMail($content));
    }

    public function AdmissionsMail(Array $info)
    {
        return Mail::to($info['email'])->send(new AdmissionsOnlineRequest($info));
    }
}
