<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Advert') }}
        </h2>
    </x-slot>
  
    <br>
     <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     {{__('status')}}: 
        @if($advert->expires_at > now() && $advert->sold == false)
            <span class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">{{__('active')}}</span>
           <!-- <span class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2" id="countdownTimer"> {{$advert->status()}}</span> -->
        @elseif($advert->expires_at < now())
            @if($advert->sold == true)
                <span class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">{{__('sold')}}</span>
            @else <span class="bg-red-500 text-white px-4 py-2 rounded-lg mr-2">{{__('expired')}}</span>
            @endif
        @endif
        
    @if(isset($advert->expires_at) && $advert->expires_at > now())
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div id="countdownTimer">
            <span id="days"></span> {{__('days')}}
            <span id="hours"></span> {{__('hours')}}
            <span id="minutes"></span> {{__('minutes')}}
            <span id="seconds"></span> {{__('seconds')}}
        </div>
     @endif
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
            <p>{{ $advert->advertisement_text }}</p>
            @if($advert->bid != null)
            <p>{{__('price')}}: {{ $advert->price }}</p>
            @endif
            <p>{{__('Posted by')}}: {{ $advert->user->name }}</p>
            @if($advert->bid != null)
            <p>{{__('Current bid')}}: {{__('$')}}{{number_format($advert->bid, 2)}}</p>
            @endif
        </div>
        <div class="mt-auto">

            @if($advert->user_id == auth()->user()->id)
            <a href="{{ route('adverts.destroy', $advert->id) }}" class ='inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150'>
                {{__('Delete')}}
            </a>                
            @endif
            @if($isFavorite)
                <a href="{{ route('adverts.unfavorite', $advert->id) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                {{__('unfavorite')}}
            </a>

            @else
                <a href="{{ route('adverts.favorite', $advert->id) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                {{__('favorite')}}
                </a>
            @endif  
            
            @if($companyCustomUrl != null)
                <a href="{{ route('company', $companyCustomUrl) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                {{__('company')}}
                </a>
            @endif
        </div>
    </div>
    
    @if($advert->advert_type == 'sale' && $advert->sold == false && $advert->user_id != auth()->user()->id && $advert->expires_at > now())
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="font-bold text-x1"><b>{{__('Buy now')}}</b></h1>
                <form action="{{ route('adverts.buy', $advert->id) }}" method="post">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('Buy now')}}</button>
                </form>
            </div>
        </div>
    @endif
    @if($advert->advert_type == 'rental' && $advert->expires_at > now())
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="font-bold text-x1"><b>{{__('Rent')}}</b></h1>
                <form action="{{ route('adverts.rent', $advert->id) }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="rent_start" class="sr-only">{{__('from')}}</label>
                        <input type="datetime-local" name="rent_start" id="rent_start" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-half p-4 rounded-lg @error('rent_start') border-red-500 @enderror" value="{{ old('rent_start') }}">
                        @error('rent_start')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="rent_end" class="sr-only">{{__('to')}}</label>
                        <input type="datetime-local" name="rent_end" id="rent_end" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-half p-4 rounded-lg @error('rent_end') border-red-500 @enderror" value="{{ old('rent_end') }}">
                        @error('rent_end')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('Rent')}}</button>
                </form>
            </div>
        </div>
    @endif
    @if($advert->user_id != auth()->user()->id && $advert->bid != null && $advert->expires_at > now())
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6" id="bidelement">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('adverts.bid', $advert->id) }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="bid" class="sr-only">{{__('bid')}}</label>
                        <input type="number" step=0.10 name="bid" id="bid" placeholder="{{__('bid')}}" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-full p-4 rounded-lg @error('bid') border-red-500 @enderror" value="{{ old('bid') }}">
                        @error('bid')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button id="bidbutton"type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('bid')}}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif  
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 flex">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-1">
                <h1 class="font-bold text-x1"><b>{{__('Rating')}}</b></h1>
                @if(isset($rating))
                    <p>{{__('Rating')}}: {{ $rating }}/5</p>
                    <p>{{__('votes')}}: {{ $ratingcount }}</p>
                @else
                    <p>{{__('No rating')}}</p>
                @endif
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-1">
                <h2 class="font-semibold text-lg">{{__('Vote')}}</h2>
             <div class="flex">
                @for ($i = 1; $i <= 5; $i++)
                    <form action="{{ route('adverts.rate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="advert_id" value="{{ $advert->id }}"> 
                        <input type="hidden" name="rating" value="{{ $i }}"> 
                        @if (isset($user_rating) && $i == $user_rating->review)
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">{{ $i }}</button>
                        @else
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">{{ $i }}</button>
                        @endif
                    </form>
                @endfor
            </div>
        </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ QrCode::size(100)->generate($QR) }} 
                </div>
            </div>
        </div>
        </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('advert.add') }}" method="post">
                        @csrf
                            <input type="hidden" name="advertidentifier" id="advertidentifier" value="{{ $advert->id }}">
                            <input type="number" name="added" id="added" placeholder="added" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-full p-4 rounded-lg @error('added') border-red-500 @enderror" value="{{ old('added') }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('Add')}}</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@if(isset($connected))
     <div class="grid md:grid-cols-2 gap-6">
                @foreach ($connected as $advert)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">

                        <div class="p-6 dark:text-gray-100 flex flex-col">
                            <a href="{{ route('adverts.show', $advert->id) }}" class="flex">
                                <div class="flex">
                                    <div class="ml-auto pr-25">
                                        <h1 class="font-bold text-x1"><b>{{ $advert->advert->title }}</b></h1>
                                        <p>{{ $advert->advert->advertisement_text }}</p>
                                        @if(isset($advert->advert->price))
                                            <p>{{__('price')}}: {{ $advert->advert->price }}</p>
                                        @endif
                                        <p>{{__('Type')}} : {{__($advert->advert->advert_type) }}</p>
                                    </div>
                                </div>
                                @if($advert->afbeelding)
                                <div> <!-- Add pl-4 class for left padding -->
                                    <img src="{{ asset('images/' . $advert->advert->afbeelding) }}" alt="Existing Image" style="width:175px; height:150px;">
                                </div>
                                @else
                                    <p>{{__('No image available')}}</p>
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endif
</div>
</x-app-layout>
@if(isset($advert->expires_at) && $advert->expires_at > now())
<script>
// Update the count down every 1 second
var countDownDate = new Date("{{ $advert->expires_at }}").getTime();
var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="countdownTimer"
    document.getElementById("days").innerText = days;
    document.getElementById("hours").innerText = hours;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("seconds").innerText = seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        let bidbutton = document.getElementById("bidelement");
        bidbutton.remove();
        
    }
}, 1000);
</script>
@endif
