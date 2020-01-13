<?php

namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeComtroller extends Controller
{
    public function index()
    {
        # code...
        dispatch(new \App\Jobs\TestLog('huyhoang'));
        return view('home');
    }
}
