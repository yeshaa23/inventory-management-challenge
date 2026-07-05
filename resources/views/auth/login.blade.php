<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />

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
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
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
                    Remember me
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm font-semibold text-red-600 hover:text-red-700"
                    href="{{ route('password.request') }}"
                >
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="gsm-button-primary w-full">
            Log in
        </button>

        <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4 text-sm text-slate-600">
            <p class="font-bold text-slate-800 mb-2">Akun Testing</p>
            <p>Admin: admin@example.com / password</p>
            <p>Staff: staff@example.com / password</p>
            <p>Manager: manager@example.com / password</p>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-red-600 hover:text-red-700">
                    Register
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
