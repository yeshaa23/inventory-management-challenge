<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-slate-100">
        <div class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
            <div class="grid w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl lg:grid-cols-2">
                <div class="hidden bg-gradient-to-br from-red-600 via-red-700 to-red-900 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white shadow-lg">
                                <img
                                    src="{{ asset('images/telkomsel-logo.png') }}"
                                    alt="Telkomsel Logo"
                                    class="h-8 w-8 object-contain"
                                >
                            </div>

                            <div>
                                <h1 class="text-2xl font-bold tracking-tight">
                                    Telkomsel Inventory
                                </h1>
                                <p class="text-sm text-red-100">
                                    Asset & Borrowing Management
                                </p>
                            </div>
                        </div>

                        <div class="mt-16">
                            <h2 class="text-4xl font-bold leading-tight">
                                Create your account
                            </h2>
                            <p class="mt-4 max-w-md text-base leading-7 text-red-100">
                                Daftar akun untuk mengakses sistem inventory, mengelola data barang,
                                peminjaman, laporan, dan aktivitas operasional.
                            </p>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-5 backdrop-blur">
                        <p class="text-sm text-red-50">
                            Pilih role akun sesuai kebutuhan akses: Admin, Staff, atau Manager.
                        </p>
                    </div>
                </div>

                <div class="flex flex-col justify-center px-6 py-10 sm:px-10 lg:px-12">
                    <div class="mb-8 text-center lg:text-left">
                        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50 shadow-sm lg:mx-0">
                            <img
                                src="{{ asset('images/telkomsel-logo.png') }}"
                                alt="Telkomsel Logo"
                                class="h-10 w-10 object-contain"
                            >
                        </div>

                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                            Create Account
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Lengkapi data di bawah untuk membuat akun baru.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                                Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-red-500 focus:ring-red-500"
                                placeholder="Enter your name"
                            >

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-red-500 focus:ring-red-500"
                                placeholder="name@example.com"
                            >

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="role_id" class="mb-2 block text-sm font-medium text-gray-700">
                                Role
                            </label>

                            <select
                                id="role_id"
                                name="role_id"
                                required
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-red-500 focus:ring-red-500"
                            >
                                <option value="">Select role</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-red-500 focus:ring-red-500"
                                placeholder="Enter your password"
                            >

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-xl border-gray-300 px-4 py-3 text-sm shadow-sm transition focus:border-red-500 focus:ring-red-500"
                                placeholder="Confirm your password"
                            >

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-red-200 transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            Register
                        </button>

                        <div class="text-center text-sm text-gray-600">
                            Already have an account?

                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-red-600 transition hover:text-red-700 hover:underline"
                            >
                                Login here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
