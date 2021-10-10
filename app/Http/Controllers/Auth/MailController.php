<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public static function sendRegisterEmail($name, $email, $verification_code){
        $data =[
            'name'=>$name,
            'verification_code'=>$verification_code,
        ];
        Mail::to($email)->send(new RegisterEmail($data));
    }
}
