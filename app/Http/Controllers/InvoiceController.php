<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceDetail;
use App\Product;
use DB;
use Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$invoices = Invoice::all();

        $invoices = Invoice::select("*",\DB::raw('(CASE WHEN invoices.is_paid = "0" THEN "No" WHEN invoices.is_paid = "1" THEN "Yes" END) AS is_paid'))->get();

        return view('admin.invoices.index', ['invoices'=>$invoices])->with('SNo', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.invoices.create',['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'txtInvoiceNo' => 'required'
        ]);

        $invoice = new Invoice();
        
        $invoice->invoice_no = $request->txtInvoiceNo;
        $invoice->invoice_date = $request->txtInvoiceDate;
        $invoice->customer_name = $request->txtCustomerName;
        $invoice->mobile_no = $request->txtMobileNo;
        $invoice->address = $request->txtAddress;
        $invoice->city = $request->txtCity;
        $invoice->remarks = $request->txtRemarks;
        $invoice->total_amount = $request->txtTotalAmount;
        $invoice->payment_mode = $request->cmbPaymentMode;
        $invoice->is_paid = $request->chkPaid;
        
        $invoice->save();

        //dd($request->txtCustomerName);
        //dd($request->txtProductDescription);
        //dd($request->all());
    
        foreach($request->txtProductId as $key => $val){     
            //echo "$key => $val"."<br>";
            $prod_id = $request->txtProductId;
            $prod_code = $request->txtProductCode;
            $prod_desc = $request->txtProductDescription;
            $qty = $request->txtQty;
            $price = $request->txtPrice;
            $discount = $request->txtDiscount;
            $amount = $request->txtAmount;

            $invoice->invoice_details()->create([
                'invoice_id'=> $invoice->id,
                'product_id' => $prod_id[$key],
                'product_code' => $prod_code[$key],
                'product_description' => $request->txtProductDescription[$key],
                'quantity' => $qty[$key],
                'price' => $price[$key],
                'discount' => $discount[$key],
                'amount' => $amount[$key],
            ]);
        }

        Session::flash('message', 'Invoice created');
        Session::flash('alert-type', 'success');
    
        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = InvoiceDetail::where('invoice_id','=',$id)->orderBy('id', 'ASC')->get();
        $products = Product::all();

        return view('admin.invoices.edit',['invoice'=>$invoice,'invoice_details'=>$invoice_details,'products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        $invoice->invoice_no = $request->txtInvoiceNo;
        $invoice->invoice_date = $request->txtInvoiceDate;
        $invoice->customer_name = $request->txtCustomerName;
        $invoice->mobile_no = $request->txtMobileNo;
        $invoice->address = $request->txtAddress;
        $invoice->city = $request->txtCity;
        $invoice->remarks = $request->txtRemarks;
        $invoice->total_amount = $request->txtTotalAmount;
        $invoice->payment_mode = $request->cmbPaymentMode;
        $invoice->is_paid = $request->chkPaid;

        $invoice->save();

        $inv_details = InvoiceDetail::where('invoice_id',$id)->delete();
        //$inv_details->delete();

        foreach($request->txtProductId as $key => $val){     
            //echo "$key => $val"."<br>";
            $prod_id = $request->txtProductId;
            $prod_code = $request->txtProductCode;
            $prod_desc = $request->txtProductDescription;
            $qty = $request->txtQty;
            $price = $request->txtPrice;
            $discount = $request->txtDiscount;
            $amount = $request->txtAmount;

            $invoice->invoice_details()->create([
                'invoice_id'=> $invoice->id,
                'product_id' => $prod_id[$key],
                'product_code' => $prod_code[$key],
                'product_description' => $request->txtProductDescription[$key],
                'quantity' => $qty[$key],
                'price' => $price[$key],
                'discount' => $discount[$key],
                'amount' => $amount[$key],
            ]);
        }

        Session::flash('message', 'Invoice updated');
        Session::flash('alert-type', 'success');
    
        return redirect()->route('invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();

        $invoice_details = InvoiceDetail::where('invoice_id',$id);
        $invoice_details->delete();

        Session::flash('message', 'Invoice deleted');
        Session::flash('alert-type', 'success');

        return redirect()->back();
    }

    public function get_product_details_by_product_id(Request $request)
    {
        $prod_id=$request->product_id;

        $prod_details=DB::table('products')->leftjoin('categories', 'products.category_id', '=', 'categories.id')->select(DB::raw("products.id,products.product_code,products.product_name,products.product_brand,products.product_model,products.product_size,products.product_colour,products.product_description,products.product_price,categories.category_name"))->where('products.id',$prod_id)->get();

        return $prod_details;
    }

  /*public function print_invoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice_details = InvoiceDetail::where('invoice_id','=',$id)->orderBy('id', 'ASC')->get();

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('pdf_invoice', compact('invoice','invoice_details'));

        // If you want to store the generated pdf to the server then you can use the store function
        //$pdf->save(storage_path().'_filename.pdf');

        // Print pdf in browser  
        return $pdf->stream("invoice.pdf", array("Attachment" => false));  
    
        // Finally, you can download the file using download function
        // return $pdf->download('users.pdf');
    }*/
}