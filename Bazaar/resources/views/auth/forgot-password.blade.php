<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('In the digital realm where secrets dwell,
        Lies a tale that many tell.
        A saga of loss, a password plight,
        Where access fades into the night.
        
        "Out of luck," the screens declare,
        With empty fields and a despairing stare.
        "Try again," they seem to mock,
        As the clock ticks and tocks, in a relentless lock.
        
        Where once was joy, now frustration looms,
        In the glow of screens in darkened rooms.
        "Bad news, login blues," we sigh and moan,
        In the quest to reclaim what was once our own.
        
        But fear not, for hope\'s not lost,
        Despite the time and patience cost.
        For every "Fate\'s sour, lost the power,"
        There\'s a reset link to restore the tower.
        
        So here\'s to passwords, long and strong,
        To keep our digital worlds from going wrong.
        May they stay remembered, clear and bright,
        Guiding us through the login night.!') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<!--    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> -->
</x-guest-layout>
