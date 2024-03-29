<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Advert') }}
        </h2>
    </x-slot>
    <br>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="POST" action="{{ route('createcompany') }}">
                            @csrf
                            <div>
                                @error('error')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="custom_url">{{ __('Custom_url: /c/...') }}</label>
                                <br>
                                <input id="custom_url" class="" type="text" name="custom_url" required autofocus style="color: black;" />
                                @error('custom_url')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror

                            </div>
                            
                            <div class="mt-4">
                                <label for="api_enabled">{{ __('Api') }}</label>
                                <br>
                                <input id="api_enabled" class="" type="checkbox" name="api_enabled" style="color: black;"/>
                            </div>
                            <div class="mt-4">
                                <label for="intro">{{ __('Intro') }}</label>
                                <br>
                                <input id="intro" class="" type="text" name="intro" style="color: black;" />
                                @error('intro')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="phone">{{ __('Phone') }}</label>
                                <br>
                                <input id="phone" class="" type="number" name="phone" required style="color: black;" />
                                @error('phone')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="email">{{ __('Email') }}</label>
                                <br>
                                <input id="email" class="" type="email" name="email" required style="color: black;" />
                                @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="address">{{ __('Address') }}</label>
                                <br>
                                <input id="address" class="" type="text" name="address" required style="color: black;" />
                                @error('address')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="city">{{ __('City') }}</label>
                                <br>
                                <input id="city" class="" type="text" name="city" required style="color: black;" />
                                @error('city')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="country">{{ __('Country') }}</label>
                                <br>
                                <input id="country" class="" type="text" name="country" required style="color: black;" />
                                @error('country')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="postal_code">{{ __('Postal Code') }}</label>
                                <br>
                                <input id="postal_code" class="" type="text" name="postal_code" required style="color: black;" />
                                @error('postal_code')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="intro_component">{{ __('Intro Text') }}</label>
                                <br>
                                <input id="intro_component" class="" type="checkbox" name="intro_component" style="color: black;"/>
                                @error('intro_component')
                                <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label for="contact_component">{{ __('Contact Gegevens') }}</label>
                                <br>
                                <input id="contact_component" class="" type="checkbox" name="contact_component" style="color: black;"/>
                            </div>
                            <div class="mt-4">
                                <label for="qr_code_component">{{ __('QR code') }}</label>
                                <br>
                                <input id="qr_code_component" class="" type="checkbox" name="qr_code_component"/>
                            </div>  
                            <div class="mt-4">
                                <label for="color">{{ __('Color') }}</label>
                                <input id="color" class="" type="color" name="color"/>
                            </div>
                            <br>
                                <x-primary-button class="ml-4">
                                    {{ __('Create') }}
                                </x-button>              
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>