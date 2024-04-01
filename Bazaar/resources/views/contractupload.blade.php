<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('contract update') }}
        </h2>
    </x-slot>
    @if(auth()->user())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-bold text-x1"><b>{{__('Create Advert')}}</b></h1>
                    
                    <form action="{{ route('contract.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-xl font-bold mb-2" for="pdf_file">
                                {{__('PDF File')}}
                            </label>
                            <div class="relative md:w-2/3 w-full">
                                <input type="hidden" name="subject" id="subject" value={{$subject}}>
                                <input class="shadow appearance-none border rounded md:w-full w-10/12 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pdf_file') border-red-500 @enderror" id="pdf_file" name="pdf_file" type="file">
                                @error('pdf_file')
                                    <p class="text-red-500 text-sm absolute top-full left-0">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                </div>
                <br>
                        
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">{{__('Create Advert')}}</button>
            </form>
        </div>
    </div>
    @else
        <p>{{__('You are not allowed to create this type of advert because you either have to many of this type active or do not have the ability to make adverts       ')}}</p>
    @endif

</x-app-layout>
