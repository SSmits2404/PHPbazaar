    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $company -> custom_url }}
            </h2>

        </x-slot>
        <div> {{$company}}</div>
        <div> {{$custom_url}}</div>

        {!! QrCode::size(300)->generate($custom_url) !!}

    </x-app-layout>
