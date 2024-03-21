<?php

namespace App\Http\Controllers;


use App\Models\Favorites;
use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\AdvertComments;

class NewAdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           $adverts = Advert::with('user')->paginate(1); // Paginates the results, 10 per page

    return view('adverts', compact('adverts'));
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
        $rating= AdvertComments::where('advert', $id)->get()->average('review');
        $ratingcount = AdvertComments::where('advert', $id)->get()->count();
        $user_rating = AdvertComments::where('advert', $id)->where('reviewer', auth()->id())->get('review')->first();
        $isFavorite = Favorites::where('advert', $id)->where('user', auth()->id())->exists();
        if($user_rating == null) {
            $user_rating = new AdvertComments();
            $user_rating->review = 0;
        }
        return view('advert', [
            'advert' => $advert,
            'rating' => round($rating, 1),
            'user_rating' => $user_rating,
            'ratingcount' => $ratingcount,
            'isFavorite' => $isFavorite
        ]);
    }

    public function rate(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'advert_id' => 'required'
        ]);

        $existingComment = AdvertComments::where('advert', $validatedData['advert_id'])
            ->where('reviewer', auth()->id())
            ->first();

        if ($existingComment) {
            $existingComment->delete();
        }

        $comment = new AdvertComments();
        $comment->reviewer = auth()->id();
        $comment->advert = $validatedData['advert_id'];
        $comment->review = $validatedData['rating'];
        $comment->save();

        return back();
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

    public function currentbid(string $id)
    {
        $advert = Advert::find($id);
        if($advert->bid == null) {
            return response()->json(['error' => 'this advert is not an auction'], $status = 405);
        }
        return response()->json(['bid' => $advert->bid], 200);
    }

    public function bid(Request $request, string $id)
    {
        $advert = Advert::findOrFail($id);
        $currentBid = $advert->bid;
        $validatedData = $request->validate([
            'bid' => 'required'
        ]);
        if($advert->expires_at < now()) {
            return back()->withErrors(['bid' => 'This auction has expired.']);
        }
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
