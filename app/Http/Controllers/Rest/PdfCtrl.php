<?php

namespace App\Http\Controllers\Rest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class PdfCtrl extends Controller
{
    //
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('myPdfFile', $data);

        return $pdf->stream();
    }
}
