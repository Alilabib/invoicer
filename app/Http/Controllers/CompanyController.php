<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //

    public function store(CompanyRequest $request)
    {

        $oldCompany = Company::where('email',$request->company['email'])->where('phone',$request->company['phone'])->first();
        if($oldCompany){
            $company = $oldCompany;
        }else{
            if(!Storage::exists('public/company')) {
                Storage::makeDirectory('public/company', 0775, true); //creates directory
            }
            if($request->file('logo')){
                $image = $request->file('logo');
                $name = 'smart_nama'. time() . $image->extension();
                $path = Storage::putFile('public/company', $request->file('logo'),);
            }else{
                $path = $request->file('logo');
            }

            $company = Company::create($request->company+['logo'=>$path]);
        }

        return redirect()->route('invoice.create',['company_id'=>$company->id]);
    }
}
