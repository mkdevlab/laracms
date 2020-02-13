<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use PDF;

class UserController extends Controller
{
  public function index(){
    return "Hello User";
  }

  public function export_pdf()
  {
    //Fetch all customers from database
    $data = User::get();

    //dd($data);

    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('pdf_users', compact('data'));
    
    // If you want to store the generated pdf to the server then you can use the store function
    //$pdf->save(storage_path().'_filename.pdf');

    // Print pdf in browser  
      return $pdf->stream("users.pdf", array("Attachment" => false));  
    
    // Finally, you can download the file using download function
    // return $pdf->download('users.pdf');

  }

}