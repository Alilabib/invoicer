<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //

    public function store(Request $request)
    {
        $path = Storage::putFile('avatars', $request->file('avatar'));
        $company = Company::create($request->company+['logo'=>$path]);
        return redirect()->route('invoice.create');
    }
}
