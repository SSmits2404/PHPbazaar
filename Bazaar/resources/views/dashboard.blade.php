<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} @if(Auth::check() && Auth::user()->role == 'admin') 
            <a href="{{route('contractupdate')}}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('contract text') }}</a>
            @endif
        </h2>
       
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="flex">
                    <div>    
                        <form action="{{ route('dashboard') }}" method="GET">
                        <input type="text" name="search" placeholder="Search">
                        <button type="submit">{{__('Search')}}</button>
                        </form> 
                    </div>
                </div>
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
                                        @if(isset($advert->price))
                                            <p>{{__('price')}}: {{ $advert->price }}</p>
                                        @endif
                                        <p>{{__('Type')}} : {{__($advert->advert_type) }}</p>
                                        <p>{{__('Posted by')}}: {{ $advert->user->name }}</p>
                                    </div>
                                </div>
                                @if($advert->afbeelding)
                                <div> <!-- Add pl-4 class for left padding -->
                                    <img src="{{ asset('images/' . $advert->afbeelding) }}" alt="Existing Image" style="width:175px; height:150px;">
                                </div>
                                @else
                                    <p>{{__('No image available')}}</p>
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $adverts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
