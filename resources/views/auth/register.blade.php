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
            <x-input-label for="role" :value="__('app.account_role')" />

            <select
                id="role"
                name="role"
                required
                class="w-full border border-slate-200 rounded-2xl px-4 py-3 text-sm text-slate-900 bg-white focus:border-red-600 focus:ring-red-600"
            >
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>
                    {{ __('app.choose_account_role') }}
                </option>

                <option value="Staff" {{ old('role') === 'Staff' ? 'selected' : '' }}>
                    {{ __('app.role_staff') }}
                </option>

                <option value="Manager" {{ old('role') === 'Manager' ? 'selected' : '' }}>
                    {{ __('app.role_manager') }}
                </option>

                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>
                    {{ __('app.role_admin') }}
                </option>
            </select>

            <p class="gsm-auth-helper-text">
                {{ __('app.role_selection_note') }}
            </p>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
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
