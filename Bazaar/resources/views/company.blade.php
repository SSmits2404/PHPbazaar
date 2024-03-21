    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $company -> custom_url }}
            </h2>

        </x-slot>
<<<<<<< Updated upstream
        <div> {{$company}}</div>

        {!! QrCode::size(300)->generate("c/{{$custom_url}}") !!}

=======
        <div class="text-white"> {{$company}}</div>
        
>>>>>>> Stashed changes
    </x-app-layout>
