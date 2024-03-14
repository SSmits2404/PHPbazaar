<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Advert') }}
        </h2>
    </x-slot>
    <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
                    <p>{{ $advert->advertisement_text }}</p>
                    <p>{{__('price')}}: {{ $advert->price }}</p>
                    <p>{{__('Posted by')}}: {{ $advert->user->name }}</p>
                    @if($advert->bid != null)
                    <p>{{__('Current bid')}}: {{__('$')}}{{number_format($advert->bid, 2)}}</p>
                    @endif
                </div>
                <div class="mt-auto">

                                @if($advert->user_id == auth()->user()->id)
                                <a href="{{ route('adverts.destroy', $advert->id) }}" class ='inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150'>
                                    Delete
                                </a>

                                @endif
                                /fix
                                @if($advert->user_id != auth()->user()->id)
                                
                                @php
                                    $isFavorite = auth()->user()->favorites->contains($advert->id);
                                @endphp

                                
                                

                                @if ($isFavorite)
                                    <a href="{{ route('adverts.unfavorite', $advert->id) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                                    unfavorite
                                </a>
                                @else
                                    <a href="{{ route('adverts.favorite', $advert->id) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                                    favorite
                                    </a>
                                @endif

                                @endif
                            </div>
                                
            </div>
            @if($advert->user_id != auth()->user()->id && $advert->bid != null)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
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
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('bid')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif  
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100"> </div>
            </div>
        </div>
    </div>

</x-app-layout>
