<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\menu_master;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Generate PDF.
     */
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download('itsolutionstuff.pdf');
    }
}
