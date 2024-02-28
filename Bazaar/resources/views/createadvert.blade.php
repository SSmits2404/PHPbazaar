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
                    <h1 class="font-bold text-x1"><b>Create Advert</b></h1>
                    <form action="{{ route('adverts.store') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="sr-only">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="advertisement_text" class="sr-only">Advertisement Text</label>
                            <textarea name="advertisement_text" id="advertisement_text" placeholder="Advertisement Text" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-full p-4 rounded-lg @error('advertisement_text') border-red-500 @enderror" value="{{ old('advertisement_text') }}"></textarea>
                            @error('advertisement_text')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="price" class="sr-only">Price</label>
                            <input type="text" name="price" id="price" placeholder="Price" class="dark:bg-gray-900 dark:text-gray-300 bg-gray-100 border-2 w-full p-4 rounded-lg @error('price') border-red-500 @enderror" value="{{ old('price') }}">
                            @error('price')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Create Advert</button>

</x-app-layout>
