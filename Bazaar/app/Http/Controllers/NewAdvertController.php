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
        $validatedData = $request->validate([
            'title' => 'required|string',
            'advertisement_text' => 'required|string',
            'price' => 'required|numeric',
            'advert_type' => 'required',
            'expires_at' => 'required|date',
            'afbeelding' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // example validation for image upload

        ]);
        $advert = new Advert();
        $advert->user_id = auth()->id();
        $advert->title = $validatedData['title'];
        $advert->advertisement_text = $validatedData['advertisement_text'];
        $advert->price = $validatedData['price'];
        $advert->expires_at = $validatedData['expires_at'];

        if ($validatedData['advert_type'] == 'auction') {
            $advert->bid = 0.00;
        }

        if ($request->hasFile('afbeelding')) {
            $image = $request->file('afbeelding');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $advert->afbeelding = $imageName;
        }

        $advert->save();

        return redirect()->route('adverts.index');
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
        
    }

    public function bid(Request $request, string $id)
    {
        $advert = Advert::findOrFail($id);
        $currentBid = $advert->bid;
        $validatedData = $request->validate([
            'bid' => 'required'
        ]);

        if($currentBid >= $validatedData['bid']) {
            return back()->withErrors(['bid' => 'Bid must be higher than the current bid.']);
        }
        $advert->bid = $validatedData['bid'];
        $advert->bidder_id = auth()->id();
        $advert->save();
        //return redirect()->route('adverts.show', ['id' => $id]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $advert = Advert::findOrFail($id);
            if(auth()->id() === $advert->user_id) {
                $advert->delete();
            }
    }
}
