<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
class AdvertController extends Controller
{
    public function index(Advert $advert) // The Advert model is automatically injected
    {
        // No need to fetch the advert manually; it's already provided by Laravel.
        $advert->load('user');
        return view('advert', [
            'advert' => $advert,
        ]);
    }

    public function overview()
    {
        $adverts = Advert::all(); // Retrieve all adverts from the Advert model

        return view('adverts', [
            'adverts' => $adverts,
        ]);
    }

    public function create()
    {
        return view('createadvert');
    }

    public function store()
    {
        $advert = new Advert();
        $advert->user_id = auth()->id();
        $advert->title = request('title');
        $advert->advertisement_text = request('advertisement_text');
        $advert->price = request('price');
        $advert->save();

        return redirect()->route('advert', ['advert' => $advert->id]);
    }
}
