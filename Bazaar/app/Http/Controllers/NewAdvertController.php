<?php

namespace App\Http\Controllers;


use App\Models\Favorites;
use Illuminate\Http\Request;
use App\Models\Advert;
use App\Models\AdvertComments;
use App\Models\User;
use App\Models\Rental;

class NewAdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $adverts = Advert::with('user')->where('user_id','!=', auth()->id()); // Paginates the results, 10 per page
        if($request['filter']){
        $adverts = $adverts->where('advert_type', '=', $request['filter']);
        }
        if($request['search']){
            $adverts = $adverts->where('title', 'like', '%' . $request['search'] . '%');
        }


        $adverts = $adverts->paginate(6);
    return view('adverts', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = request('type');

        return view('createadvert',[ 'type' => $type]);
    }

    public function bought()
    {
       
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        #ddd($request);
        $validatedData = $request->validate([
            'title' => 'required',
            'advertisement_text' => 'required',
            'expiry_moment' => 'required',
            'type' => 'required'
        ]);
        
        if($request['advert_type'] == 'sale'){
            $extravalidateddata = $request->validate([
                'price' => 'required'
            ]);
        }
        $advert = new Advert();
        $advert->user_id = auth()->id();
        $advert->advert_type = $request['advert_type'];


        $advert->title = $request['title'];
        $advert->advertisement_text = $request['advertisement_text'];
        $advert->price = $request['price'];
        $advert->expires_at = $request['expires_at'];
        $advert->advert_type = $request['type'];

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

    public function rent($id, Request $request)
    {
        $advert = Advert::findOrFail($id);
        if($advert->isrental == false)
        {
            return back()->withErrors(['rent' => 'this is not a rental.']);
        }
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        $existingBookings = Rental::where('advert_id', $id)
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($query) use ($validatedData) {
                    $query->where('start_date', '>=', $validatedData['start_date'])
                        ->where('start_date', '<=', $validatedData['end_date']);
                })->orWhere(function ($query) use ($validatedData) {
                    $query->where('end_date', '>=', $validatedData['start_date'])
                        ->where('end_date', '<=', $validatedData['end_date']);
                });
            })
            ->exists();

        if ($existingBookings) {
            return back()->withErrors(['rent' => 'There is an existing booking that overlaps with this new booking.']);
        }
        $rental = new Rental();
        $rental->advert_id = $id;
        $rental->renter_id = auth()->id();
        $rental->start_date = $validatedData['start_date'];
        $rental->end_date = $validatedData['end_date'];
        $rental->save(); 
        return redirect()->route('adverts.show', $id);
    }

    public function buy($id, Request $request)
    {
        $advert = Advert::findOrFail($id);
        if($advert->advert_type == 'auction') {
            return back()->withErrors(['buy' => 'This is an auction.']);
        }
        if($advert->sold) {
            return back()->withErrors(['buy' => 'This advert has already been sold.']);
        }
        $advert->sold = true;
        $advert->bidder_id = auth()->id();
        $advert->expires_at = now();
        $advert->save();
        return redirect()->route('adverts.show', $id);
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
        $QR = url("/adverts/{$id}");
        return view('advert', [
            'advert' => $advert,
            'rating' => round($rating, 1),
            'user_rating' => $user_rating,
            'ratingcount' => $ratingcount,
            'isFavorite' => $isFavorite,
            'QR' => $QR

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

    public function showFavorites()
{
    $favorites = Favorites::where('user', auth()->id()) // Update sure the column name to 'user'
                          ->paginate(1);

    foreach($favorites as $favorite) {
        $favorite->advert = Advert::find($favorite->advert);
        $favorite->advert->load('user');
    }

    return view('favorites', [
        'favorites' => $favorites,
    ]);
}

}
