<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(string $company)
    {
        $company = Company::where('custom_url', $company)->first();
        if($company == null)
        {
            return view('welcome');
        }
        else{
        return view('company', ['company' => $company]);
        }
    }


}
