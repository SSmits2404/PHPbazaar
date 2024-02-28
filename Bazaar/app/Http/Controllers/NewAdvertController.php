<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
class NewAdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = Advert::all(); // Retrieve all adverts from the Advert model

        return view('adverts', [
            'adverts' => $adverts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createadvert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $advert = new Advert();
        $advert->user_id = auth()->id();
        $advert->title = request('title');
        $advert->advertisement_text = request('advertisement_text');
        $advert->price = request('price');
        $advert->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advert = Advert::findOrFail($id);
           $advert->load('user');
        return view('advert', [
            'advert' => $advert,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // test
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
