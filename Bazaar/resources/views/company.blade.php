    <x-app-layout :item="$company">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $company->custom_url }}
            </h2>
        </x-slot>
        <br>
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
    </x-app-layout>
