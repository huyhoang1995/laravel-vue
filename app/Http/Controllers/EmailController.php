<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use App\Events\UserRegistered;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $user = [
            'name' => 'huyhoang',
            'email' => 'concuru@gmail.com',
            'password' => bcrypt(123456),
        ];
        event(new UserRegistered($user));


        echo 'email sent';
    }
}
