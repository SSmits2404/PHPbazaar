    <x-app-layout :item="$company">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $company->custom_url }}
            </h2>
            <br>
            <h3>
            @if($company->owner_id == auth()->user()->id && $hasunaprovedcontract)
            <a href="{{ route('contract.unapproved', ['subject' => $company])}} class="bg-green-500 text-white px-4 py-3 rounded font-medium">{{ __('download contract') }}</a>
            @endif
            </h3>
        </x-slot>
        <br>
        @if(Auth::user()->role == "admin")
        <a href="{{ route('contract.upload', ['subject' => 1]) }}" class="bg-green-500 text-white px-4 py-3 rounded font-medium">{{ __("Upload new contract") }}</a>
        @endif
        @if($company->owner_id == auth()->user()->id && $hasunaprovedcontract)
            <a href="{{ route('contract.approve') }}" class="bg-green-500 text-white px-4 py-3 rounded font-medium">{{__('approve contract')}}</a>
        @endif
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-6">
                    @if($company->qr_code_component)
                    <x-qr-code></x-qr-code>
                    @endif
                    @if($company->intro_component)
                    <x-introtext></x-introtext>
                    @endif
                    @if($company->contact_component)
                    <x-contact></x-contact>
                    @endif

                    <div style="background-color: {{ $company->color }}; height: 100px"></div>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 flex">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-1">
                <h1 class="font-bold text-x1"><b>{{__('Rating')}}</b></h1>
                @if(isset($rating))
                    <p>{{__('Rating')}}: {{ $rating }}/5</p>
                    <p>{{__('votes')}}: {{ $ratingcount }}</p>
                @else
                    <p>{{__('No rating')}}</p>
                @endif
            </div>
            <div class="p-6 text-gray-900 dark:text-gray-100 flex-1">
                <h2 class="font-semibold text-lg">{{__('Vote')}}</h2>
                <div class="flex">
                    @if($company->owner_id == auth()->user()->id)
                        <p>{{__('You cannot rate your own company')}}</p>
                    @else
                    @for ($i = 1; $i <= 5; $i++)
                        <form action="{{ route('company.rate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $company->id }}"> 
                            <input type="hidden" name="rating" value="{{ $i }}"> 
                            @if (isset($user_rating) && $i == $user_rating->review)
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2">{{ $i }}</button>
                            @else
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2">{{ $i }}</button>
                            @endif
                        </form>
                    @endfor
                    @endif
                </div>
             </div>       
        </div>
    </x-app-layout>
