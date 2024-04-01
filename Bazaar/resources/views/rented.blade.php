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
                    @foreach($rentedAdverts as $rented)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                        <div class="p-6 dark:text-gray-100 flex flex-col">
                            <div class="flex">
                                <div class="ml-auto pr-25">
                                    {{__('Title')}}: {{ $rented->advert->title}}
                                    <br>
                                    {{__('Start Date')}}: {{ $rented->start_date}}
                                    <br>
                                    {{__('End Date')}}: {{ $rented->end_date}}
                                    @if(now() < $rented->end_date && now() > $rented->start_date && $rented->available == true && $rented->picked_up == false && $rented->advert->durability > 0)
                                        <br>
                                        <x-primary-button>
                                            <a href="{{ route('rented.pickUp', ['id' => $rented->id]) }}">{{ __('Pick up') }}</a>
                                        </x-primary-button>
                                    @elseif(now() < $rented->end_date && now() > $rented->start_date && $rented->available == true && $rented->picked_up == true)
                                        <br>
                                        <x-primary-button>
                                            <a href="{{ route('return', ['id' => $rented->id]) }}">{{ __('Return') }}</a>
                                        </x-primary-button>
                                    @elseif(now() < $rented->end_date && $rented->start_date < now() && $rented->available == false)
                                        <br>
                                        {{__('this item has been returned')}}
                                    @elseif($rented->advert->durability == 0)
                                        <br>
                                        {{__('this item is unfortunately broken')}}
                                        <br>
                                        {{__('please contact the owner, or wait till it is fixed')}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4">
                {{ $rentedAdverts->links() }}
            </div>
        </div>
    </div>   
</x-app-layout>