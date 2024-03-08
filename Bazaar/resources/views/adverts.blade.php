<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adverts') }}
            <a href="{{ route('adverts.create') }}" class="bg-green-500 text-white px-4 py-3 rounded font-medium">{{__('new')}}</a>   
            <div class="py-12">
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <x-filter-bar></x-filter-bar>   
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach ($adverts as $advert)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                        <div class="p-6 dark:text-gray-100 flex flex-col">
                            <a href="{{ route('adverts.show', $advert->id) }}" class="flex">
                                <div class="flex">
                                    <div class="ml-auto pr-25">
                                        <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
                                        <p>{{ $advert->advertisement_text }}</p>
                                        <p>{{__('price')}}: {{ $advert->price }}</p>
                                        <p>{{__('Posted by')}}: {{ $advert->user->name }}</p>
                                    </div>
                                </div>
                                @if($advert->afbeelding)
                                <div> <!-- Add pl-4 class for left padding -->
                                    <img src="{{ asset('images/' . $advert->afbeelding) }}" alt="Existing Image" style="width:175px; height:150px;">
                                </div>
                                @else
                                    <p>No image available</p>
                                @endif
                               
                            <div class="mt-auto">

                                @if($advert->user_id == auth()->user()->id)
                                <a href="{{ route('adverts.destroy', $advert->id) }}" class ='inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150'>
                                    Delete
                                </a>

                                @endif
                                @if($advert->user_id != auth()->user()->id)
                                
                                @php
                                    $isFavorite = route('adverts.isFavorite', $advert->id);
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
                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>
