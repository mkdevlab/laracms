<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>'admin'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('category', 'CategoryController');
	Route::resource('product', 'ProductController');

	//Route::get('invoice/printinvoice/{$id}','InvoiceController@print_invoice')->name('invoice.printinvoice');
	Route::resource('invoice', 'InvoiceController');
	
	Route::post('get_product_details','InvoiceController@get_product_details_by_product_id')->name('get_product_details');
});

//Route::get('generate-pdf','HomeController@generatePDF');

//Route::get('/users','UserController@index');
//Route::get('/users/pdf','UserController@export_pdf');

Route::get('/test', 'TestController@index')->name('test.index');

Route::get('/test/create', 'TestController@create')->name('test.create');

Route::post('/test', 'TestController@store')->name('test.store');

Route::get('/test/{id}/edit', 'TestController@edit')->name('test.edit');

Route::post('/test/{id}', 'TestController@update')->name('test.update');

Route::get('/test/{id}', 'TestController@show')->name('test.show');

Route::post('/test/{id}', 'TestController@destroy')->name('test.destroy');