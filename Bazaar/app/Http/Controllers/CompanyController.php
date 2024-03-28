<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function view(string $company)
    {
        $company = Company::where('custom_url', $company)->first();
       
        if($company == null)
        {
            return redirect('/');
        }

        $customurl = url("/c/{$company->custom_url}");
        return view('company', ['company' => $company, 'custom_url' => $customurl]);
    }

    public function overview()
    {
        $companies = Company::paginate(1);
        return view('companies', [
            'companies' => $companies,
        ]);
    }
    public function getIntroText(Company $company)
    {
        return $company->intro_text;
    }
}
