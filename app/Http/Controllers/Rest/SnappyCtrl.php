<?php

namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class SnappyCtrl extends Controller
{
    public function getPrint()
    {
        $pdf = \PDF::loadView('print');
        return $pdf->download('print.pdf');
    }
}
