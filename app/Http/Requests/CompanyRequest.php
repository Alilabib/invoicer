<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company.email'   =>'required|email',
            'company.name'    =>'nullable|string',
            'company.country' =>'nullable|string',
            'company.city'    =>'nullable|string',
            'company.phone'   =>'required|numeric',
            'company.state'   =>'nullable|string',
            'company.postcode'=>'nullable|string',
            'company.address' =>'nullable|string',
            'company.vat'     =>'nullable|string',
            'logo'            =>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ];
    }
}
