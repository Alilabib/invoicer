<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'company_id'       =>'required|exists,companies,id',
            'invoice.number'   =>'required|string',
            'invoice.date'     =>'required|date|format:',
            'customer.name'    =>'required|string',
            'customer.address' =>'required|string',
            'customer.postcode'=>'required|string',
            'customer.city'    =>'required|string',
            'customer.postcode'=>'required|string',
            'customer.state'   =>'required|string',
            'customer.country' =>'required|string',
            'customer.email'   =>'required|email',
            'customer.phone'   =>'required|string|numeric',
            'customer_fields'  =>'nullable|array',
            'customer_fields.*.field_key'=>'nullable|string',
            'customer_fields.*.field_value'=>'nullable|string',
            'products'=>'required|array',
            'products.*'=>'required|string',
            'qty'=>'required|array',
            'qty.*'=>'required|numeric',
            'price'=>'required|array',
            'price.*'=>'required|numeric',
            'total'=>'required|array',
            'total.*'=>'required|numeric',
            'invoice.sub_total'=>'required|numeric',
            'invoice.tax'=>'required|numeric',
            'invoice.tax_amount'=>'required|numeric',
            'invoice.total_amount'=>'required|numeric'
        ];
    }
}
