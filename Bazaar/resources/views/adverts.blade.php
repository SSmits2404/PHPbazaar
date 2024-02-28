<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adverts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-bold text-x1"><b>Adverts</b></h1>
                    <p>Here are all the adverts</p>
                    <p>Click on an advert to view it</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach ($adverts as $advert)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                        <div class="p-6">
                            <a href="{{ route('advert', $advert->id) }}">
                                <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
                                <p>{{ $advert->advertisement_text }}</p>
                                <p>Price: {{ $advert->price }}</p>
                                <p>Posted by: {{ $advert->user->name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>
