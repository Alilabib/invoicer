<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldInvoice extends Model
{
    //
    protected $guarded = ['id','created_at','updated_at'];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

}
