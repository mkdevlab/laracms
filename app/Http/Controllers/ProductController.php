<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Session;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$products = Product::all();

        $products = DB::table('products')->leftjoin('categories', 'products.category_id', '=', 'categories.id')
                                           ->select(DB::raw("products.id,products.product_code,products.product_name,products.product_price,products.product_quantity,products.product_image,categories.category_name,(CASE WHEN (products.is_active = 1) THEN 'Yes' ELSE 'No' END) as is_active"))
                                           ->where('products.is_delete', '=', 0)->get();

        return view('admin.products.index',['products'=>$products])->with('SNo', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create',['categories'=>$categories]);
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
            'txtProductName' => 'required|max:255'
        ]);

        $product = new Product;
        
        $product->product_code = $request->txtProductCode;
        $product->product_name = $request->txtProductName; 
        $product->category_id = $request->cmbCategory; 
        $product->product_brand = $request->txtProductBrand; 
        $product->product_model = $request->txtProductModel; 
        $product->product_colour = $request->txtProductColour; 
        $product->product_size = $request->txtProductSize; 
        $product->product_description = $request->txtProductDescription; 
        $product->product_price = $request->txtProductPrice; 
        $product->product_quantity = $request->txtProductQuantity; 
        $product->product_remarks = $request->txtProductRemarks; 
        $product->is_active = $request->chkActive; 

        if($files=$request->file('txtProductImage')){
        
            $prodimg=$files->getClientOriginalName();
            
            $files->move('uploads/products',$prodimg);
           
            $product->product_image = 'uploads/products/'.$prodimg;     
        }

        $product->save(); 

        Session::flash('message', 'Product created');
        Session::flash('alert-type', 'success');
    
        return redirect()->route('product.index');
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
        $categories = Category::all();

        $product = Product::find($id);

        return view('admin.products.edit',['categories'=>$categories,'product'=>$product ]);
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
        $product = Product::find($id);
        
        $product->product_code = $request->txtProductCode;
        $product->product_name = $request->txtProductName; 
        $product->category_id = $request->cmbCategory; 
        $product->product_brand = $request->txtProductBrand; 
        $product->product_model = $request->txtProductModel; 
        $product->product_colour = $request->txtProductColour; 
        $product->product_size = $request->txtProductSize; 
        $product->product_description = $request->txtProductDescription; 
        $product->product_price = $request->txtProductPrice; 
        $product->product_quantity = $request->txtProductQuantity; 
        $product->product_remarks = $request->txtProductRemarks; 
        $product->is_active = $request->chkActive; 

        if($files=$request->file('txtProductImage')){
        
            $prodimg=$files->getClientOriginalName();
            
            $files->move('uploads/products/',$prodimg);
           
            $product->product_image = 'uploads/products/'.$prodimg;     
        }

        $product->save(); 

        Session::flash('message', 'Product updated');
        Session::flash('alert-type', 'success');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(file_exists($product->txtProductImage)){
            unlink($product->txtProductImage);
        }

        $product->delete(); 

        Session::flash('message', 'Product deleted');
        Session::flash('alert-type', 'success');

        return redirect()->back();
    }
}