<section>
    <header>
        <p class="gsm-eyebrow">
            {{ __('app.profile_information') }}
        </p>

        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
            {{ __('app.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">
            {{ __('app.profile_information_desc') }}
        </p>
    </header>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        @php
            $user = $user ?? auth()->user();

            $avatarUrl = null;

            if (!empty($user->profile_photo_path)) {
                $avatarUrl = \Illuminate\Support\Facades\Storage::url($user->profile_photo_path);
            }

            $initial = strtoupper(substr($user->name, 0, 1));
        @endphp

        <div class="gsm-profile-photo-field">
            <div class="gsm-profile-photo-preview">
                @if($avatarUrl)
                    <img
                        id="profile-photo-preview"
                        src="{{ $avatarUrl }}"
                        alt="{{ $user->name }}"
                    >

                    <span id="profile-photo-initial" class="hidden">
                        {{ $initial }}
                    </span>
                @else
                    <img
                        id="profile-photo-preview"
                        src=""
                        alt="{{ $user->name }}"
                        class="hidden"
                    >

                    <span id="profile-photo-initial">
                        {{ $initial }}
                    </span>
                @endif
            </div>

            <div class="gsm-profile-photo-content">
                <label for="profile_photo">
                    {{ __('app.profile_photo') }}
                </label>

                <p>
                    {{ __('app.profile_photo_desc') }}
                </p>

                <input
                    type="file"
                    name="profile_photo"
                    id="profile_photo"
                    accept="image/png, image/jpeg, image/jpg"
                >

                @error('profile_photo')
                    <p class="gsm-error-text">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="gsm-field">
            <label for="name">
                {{ __('app.name') }}
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >

            @error('name')
                <p class="gsm-error-text">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="gsm-field">
            <label for="email">
                {{ __('app.email') }}
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >

            @error('email')
                <p class="gsm-error-text">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="gsm-button-primary">
                {{ __('app.save_profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-500 dark:text-slate-300"
                >
                    {{ __('app.saved') }}
                </p>
            @endif
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const photoInput = document.getElementById('profile_photo');
            const photoPreview = document.getElementById('profile-photo-preview');
            const photoInitial = document.getElementById('profile-photo-initial');

            if (!photoInput || !photoPreview || !photoInitial) {
                return;
            }

            photoInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    photoPreview.src = event.target.result;
                    photoPreview.classList.remove('hidden');
                    photoInitial.classList.add('hidden');
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
</section>
