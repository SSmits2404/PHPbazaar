<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agenda') }}
            <br>
            <x-primary-button>
                <a href="{{ route('ownRent') }}">{{ __('Own rents') }}</a>
            </x-primary-button>
            <x-primary-button>
                <a href="{{ route('rented') }}">{{ __('Rented') }}</a>
            </x-primary-button>
            <x-primary-button>
                <a href="{{ route('expiry') }}">{{ __('Expiries') }}</a>
            </x-primary-button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="grid md:grid-cols-2 gap-6">                
                    @foreach($ownRentals as $own)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                            <div class="p-6 dark:text-gray-100 flex flex-col">
                                <div class="flex">
                                    <div class="ml-auto pr-25">
                                        {{__('Start Date')}}: {{ $own->start_date}}
                                        <br>
                                        {{__('End Date')}}: {{ $own->end_date}}
                                    </div>
                                </div>
                            </div>
                        </div>                               
                    @endforeach
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>