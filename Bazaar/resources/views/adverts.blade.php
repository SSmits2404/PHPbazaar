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
                        <div class="p-6 dark:text-gray-100">
                            <a href="{{ route('adverts.show', $advert->id) }}">
                                <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
                                <p>{{ $advert->advertisement_text }}</p>

                                <p>{{__('price')}}: {{ $advert->price }}</p>
                                <p>{{__('Posted by')}}: {{ $advert->user->name }}</p>

                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>
