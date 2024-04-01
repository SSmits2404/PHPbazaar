<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserComments;
use App\Models\Company;
use App\Models\Contract;

class CompanyController extends Controller
{
    public function view(string $company)
    {
        
        $company = Company::where('custom_url', $company)->first();
        $id = $company->id;
        $rating= UserComments::where('reviewee', $id)->get()->average('review');
        $ratingcount = UserComments::where('reviewee', $id)->get()->count();
        $user_rating = UserComments::where('reviewee', $id)->where('reviewer', auth()->id())->get('review')->first(); 
       $hasunaprovedcontract = Contract::where('approved', false)->where('subject_user_id', auth()->id())->orderBy('created_at', 'desc')->first(); 
        
       
        if($company == null)
        {
            return redirect('/');
        }

        $customurl = url("/c/{$company->custom_url}");
        return view('company', 
        ['company' => $company,
        'id' => $id,
        'custom_url' => $customurl,
        'rating' => round($rating, 1),
        'user_rating' => $user_rating,
        'ratingcount' => $ratingcount,
        'hasunaprovedcontract' => $hasunaprovedcontract
    
    ]);
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

    public function create()
    {
        return view('createcompany');
    }

    public function store(Request $request)
    {


        if($request['api_enabled'] == 'on'){
            $request['api_enabled'] = 1;
        } else {
            $request['api_enabled'] = 0;
        }
        if($request['intro_component']){
            $request['intro_component'] = 1;
        } else {
            $request['intro_component'] = 0;
        }
        if($request['contact_component']){
            $request['contact_component'] = 1;
        } else {
            $request['contact_component'] = 0;
        }
        if($request['qr_code_component']){
            $request['qr_code_component'] = 1;
        } else {
            $request['qr_code_component'] = 0;
        }
        
        if(Company::where('custom_url', $request->custom_url)->exists()){
            return back()->withErrors(['custom_url' => 'url already exists']);
        }
        if(Company::where('owner_id', auth()->id())->exists()){
            return back()->withErrors(['error' => 'already have a company']);
        }
        
        
        $company = new Company();
        $company->owner_id = auth()->id();
        $company->custom_url = $request->custom_url;
        $company->api_enabled = $request->api_enabled;
        $company->intro = $request->intro;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->city = $request->city;
        $company->country = $request->country;
        $company->postal_code = $request->postal_code;
        $company->intro_component = $request->intro_component;
        $company->contact_component = $request->contact_component;
        $company->color = $request->color;
        $company->save();
        return redirect('/c/'.$request->custom_url);
    }

    public function rate(Request $request)
    {
  
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'id' => 'required'
        ]);
        $existingComment = UserComments::where('reviewer', auth()->id())
            ->first();

        if ($existingComment) {
            $existingComment->delete();
        }

        $comment = new UserComments();
        $comment->reviewer = auth()->id();
        $comment->reviewee = $validatedData['id'];
        $comment->review = $validatedData['rating'];
        $comment->save();

        return back();
    }
}
