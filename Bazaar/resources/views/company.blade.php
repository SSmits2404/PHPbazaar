    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $company -> custom_url }}
            </h2>

        </x-slot>
        <br>
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-6">
            <x-qr-code></x-qr-code>
            
            <x-introtext></x-introtext>
            
            <x-contact></x-contact>
        </div>
        </div>
        </div>

    </x-app-layout>
