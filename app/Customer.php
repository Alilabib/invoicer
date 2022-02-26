<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $guarded = ['id','created_at','updated_at'];


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'invoice_id', 'id');
    }
}
