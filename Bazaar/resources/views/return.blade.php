<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('return') }}	
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-bold text-x1"><b>{{__('Return')}}</b></h1>
                    
                    <form action="{{ route('rented.returnItem') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$id}}"/>
                        @csrf
                        <div class="md:flex gap-8 justify-between">
                            <label class="block text-gray-700 text-xl font-bold mb-2" for="afbeelding">
                            {{__('Afbeelding')}}
                            </label>
                            <div class="relative md:w-2/3 w-full">
                                <input class="shadow appearance-none border rounded md:w-full w-10/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('afbeelding') border-red-500 @enderror" id="afbeelding" name="afbeelding" type="file">
                                @error('afbeelding')
                                    <p class="text-red-500 text-sm absolute top-full left-0">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <br>        
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('Return')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
