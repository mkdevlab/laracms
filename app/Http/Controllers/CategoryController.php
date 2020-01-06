<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$categories = Category::all();

      //DB::enableQueryLog(); 
      //DB::table('categories')->select(DB::raw("id,category_name,(CASE WHEN (is_active = 1) THEN 'Active' ELSE 'InActive' END) as is_active"))->where('is_delete', '=', 0)->get();
      //dd(DB::getQueryLog());

       $categories = DB::table('categories')->select(DB::raw("id,category_name,(CASE WHEN (is_active = 1) THEN 'Yes' ELSE 'No' END) as is_active"))->where('is_delete', '=', 0)->get();
        
       return view('admin.categories.index',['categories' => $categories])->with('SNo', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($requetxtCategoryNamest->all());

        $this->validate($request, [
            'txtCategoryName' => 'required|max:255'
        ]);

        $category = new Category;
        
        $category->category_name = $request->txtCategoryName; 
        $category->is_active = $request->chkActive; 

        $category->save(); 

        Session::flash('message', 'Category created');
        Session::flash('alert-type', 'success');
    
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$category = Category::find($id);
        //return view('admin.categories.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit',['category'=>$category]);
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
        $category = Category::find($id);
        
        $category->category_name = $request->txtCategoryName; 
        $category->is_active = $request->chkActive; 

        $category->save(); 

        Session::flash('message', 'Category updated');
        Session::flash('alert-type', 'success');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete(); 

        Session::flash('message', 'Category deleted');
        Session::flash('alert-type', 'success');

        return redirect()->back();
    }
}
