<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $guarded = ['id','created_at','updated_at'];


    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function fields()
    {
        return $this->hasMany(FieldInvoice::class, 'invoice_id', 'id');
    }


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach($this->items as $item){
            $total += $item->price * $item->qty;
        }
        return $total;
    }

}
