<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $guarded = ['id','created_at','updated_at'];


    public function customers()
    {
        return $this->hasMany(Customer::class, 'company_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'invoice_id', 'id');
    }


}
