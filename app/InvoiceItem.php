<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    //
    protected $guarded = ['id','created_at','updated_at'];

    public function getTotalAttribute()
    {
        return $this->qty * $this->price;
    }

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

}
