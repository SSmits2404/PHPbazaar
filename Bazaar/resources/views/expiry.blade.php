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
                <div class="flex">
                    <div>        
                        <x-secondary-button>
                            <a href="{{ route('expiry', ['filter' => 'sale']) }}">Buy</a>
                        </x-secondary-button>
                        <x-secondary-button>
                            <a href="{{ route('expiry', ['filter' => "rental"]) }}">Rent</a>
                        </x-secondary-button>
                        <x-secondary-button>
                            <a href="{{ route('expiry', ['filter' => 'auction']) }}">Auction</a>
                        </x-secondary-button>
                        <form action="{{ route('expiry') }}" method="GET">
                            <input type="text" name="search" placeholder="Search">
                            <button type="submit">{{__('Search')}}</button>
                        </form>                                     
                    </div>
                </div>
            </div>
            <br>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="grid md:grid-cols-2 gap-6">          
                    @foreach($rentalExpiry as $expiry)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                        <div class="p-6 dark:text-gray-100 flex flex-col">
                            <div class="flex">
                                <div class="ml-auto pr-25">
                                    {{__('Title')}}: {{ $expiry-> title}}
                                    <br>
                                    {{__('Exipres at')}}: {{ $expiry->expires_at}}
                                    <br>
                                    {{__('Type')}}: {{ $expiry->advert_type}}
                                    </div>
                                    <br>
                                    @if($expiry->durability == 0 && $expiry->durability != null)
                                    <a href="{{ route('expiry.repair', $expiry->id) }}" class="inline-flex items-center px-4 py-2 bg-red-500 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-red-700 dark:hover:bg-red focus:bg-red-700 dark:focus:bg-red active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-red-800 transition ease-in-out duration-150">
                                        {{__('repair')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                {{ $rentalExpiry->links() }}
            </div>
        </div>
    </div>
</x-app-layout>