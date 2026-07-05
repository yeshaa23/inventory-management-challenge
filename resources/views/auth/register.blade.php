<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('app.name')" />

            <x-text-input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="{{ __('app.full_name_placeholder') }}"
            />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('app.email')" />

            <x-text-input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="nama@email.com"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('app.password')" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="{{ __('app.min_8_chars') }}"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('app.confirm_password')" />

            <x-text-input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="{{ __('app.repeat_password') }}"
            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="gsm-button-primary w-full">
            {{ __('app.register') }}
        </button>

        <p class="text-center text-sm text-slate-500">
            {{ __('app.already_have_account') }}
            <a href="{{ route('login') }}" class="font-bold text-red-600 hover:text-red-700">
                {{ __('app.login') }}
            </a>
        </p>
    </form>
</x-guest-layout>
