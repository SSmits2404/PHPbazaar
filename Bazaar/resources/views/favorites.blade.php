<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Favorites') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                 @foreach ($favorites as $favorite)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">

                        <div class="p-6 dark:text-gray-100 flex flex-col">
                            <a href="{{ route('adverts.show', $favorite->advert->id) }}" class="flex">
                                <div class="flex">
                                    <div class="ml-auto pr-25">
                                        <h1 class="font-bold text-x1"><b>{{ $favorite->advert->title }}</b></h1>
                                        <p>{{ $favorite->advert->advertisement_text }}</p>
                                        <p>{{__('price')}}: {{ $favorite->advert->price }}</p>
                                        <p>{{__('Posted by')}}: {{ $favorite->advert->user->name }}</p>
                                    </div>
                                </div>
                                @if($favorite->advert->afbeelding)
                                <div> <!-- Add pl-4 class for left padding -->
                                    <img src="{{ asset('images/' . $favorite->advert->afbeelding) }}" alt="Existing Image" style="width:175px; height:150px;">
                                </div>
                                @else
                                    <p>No image available</p>
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $favorites->links() }}
            </div>
        </div>
    </div>
</x-app-layout>