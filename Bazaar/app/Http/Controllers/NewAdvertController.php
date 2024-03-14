<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
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
        $advert->title = $request['title'];
        $advert->advertisement_text = $request['advertisement_text'];
        $advert->price = $request['price'];
        $advert->expires_at = $request['expires_at'];

        if ($request['advert_type'] == 'auction') {
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


    public function favorite(string $id)
    {
        $existingFavorite = Favorites::where('advert', $id)->where('user', auth()->id())->first();
        if ($existingFavorite) {
            return back()->withErrors(['favorite' => 'This advert is already in your favorites.']);
        }
        $favorite = new Favorites();
        $favorite->advert = $id;
        $favorite->user = auth()->id();
        $favorite->added = now();
        $favorite->save();
        return redirect()->route('adverts.show', $id);
    }
    public function unfavorite(string $id)
    {
        $favorite = Favorites::where('user', auth()->id())->where('advert', $id);
                $favorite->delete();
        return redirect()->route('adverts.show', $id);
    }
    
    public function isFavorite(string $id)
    {
         return $this->favorites()->where('advert', $id)->where('user', auth()->id())->exists();
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
            return redirect()->route('adverts.index');
    }
}
