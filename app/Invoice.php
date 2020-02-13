<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoice_details(){
    	return $this->hasMany('App\InvoiceDetail', 'invoice_id');
    }
}
