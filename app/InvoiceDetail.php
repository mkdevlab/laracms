<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{

	protected $fillable = ['invoice_id','product_id','product_code','product_description','quantity','price','discount','amount'];

    public function invoice() {
    	return $this->belongsTo('App\Invoice');
	}

	public function getFormattedPriceAttribute()
	{
	    return number_format($this->attributes['price'], 2);
	}
}
