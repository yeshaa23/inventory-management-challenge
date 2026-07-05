<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('app.email')" />

            <x-text-input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="admin@example.com"
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
                autocomplete="current-password"
                placeholder="{{ __('app.login_placeholder_password') }}"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-slate-300 text-red-600 shadow-sm focus:ring-red-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-slate-600">
                    {{ __('app.remember_me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm font-semibold text-red-600 hover:text-red-700"
                    href="{{ route('password.request') }}"
                >
                    {{ __('app.forgot_password') }}
                </a>
            @endif
        </div>

        <button type="submit" class="gsm-button-primary w-full">
            {{ __('app.login') }}
        </button>

        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 text-sm text-slate-600">
            <p class="font-bold text-slate-800 mb-2">{{ __('app.test_accounts') }}</p>
            <p>Admin: admin@example.com / password</p>
            <p>Staff: staff@example.com / password</p>
            <p>Manager: manager@example.com / password</p>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-500">
                {{ __('app.dont_have_account') }}
                <a href="{{ route('register') }}" class="font-bold text-red-600 hover:text-red-700">
                    {{ __('app.register') }}
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
