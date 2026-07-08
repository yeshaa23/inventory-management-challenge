<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('app.app_name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

        <script>
            try {
                if (localStorage.getItem('theme') === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (error) {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-slate-900 dark:text-white">
        <div class="gsm-shell">
            <aside id="app-sidebar" class="gsm-sidebar">
                <div>
                    <div class="gsm-brand-card">
                        <div class="gsm-logo-mark">
                            <img
                                src="{{ asset('images/telkomsel-logo.png') }}"
                                alt="Telkomsel Logo"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                            >

                            <span class="gsm-logo-fallback" style="display: none;">
                                T
                            </span>
                        </div>

                        <div class="gsm-brand-text">
                            <h1>Telkomsel</h1>
                            <p>{{ __('app.inventory_center') }}</p>
                        </div>
                    </div>

                    <nav class="gsm-nav">
                        <p class="gsm-nav-title">
                            {{ __('app.main_menu') }}
                        </p>

                        <a
                            href="{{ route('dashboard') }}"
                            class="gsm-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        >
                            <span class="gsm-nav-icon">⌂</span>
                            <span>{{ __('app.dashboard') }}</span>
                        </a>

                        @if(auth()->user()->hasRole(['Admin', 'Staff']))
                            <a
                                href="{{ route('categories.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                            >
                                <span class="gsm-nav-icon">▦</span>
                                <span>{{ __('app.categories') }}</span>
                            </a>

                            <a
                                href="{{ route('products.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                            >
                                <span class="gsm-nav-icon">◈</span>
                                <span>{{ __('app.products') }}</span>
                            </a>

                            <a
                                href="{{ route('borrowings.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}"
                            >
                                <span class="gsm-nav-icon">↔</span>
                                <span>{{ __('app.borrowings') }}</span>
                            </a>
                        @endif

                        @if(auth()->user()->hasRole(['Admin', 'Manager']))
                            <a
                                href="{{ route('reports.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                            >
                                <span class="gsm-nav-icon">▤</span>
                                <span>{{ __('app.reports') }}</span>
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('Admin'))
                            <a
                                href="{{ route('activity-logs.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}"
                            >
                                <span class="gsm-nav-icon">◎</span>
                                <span>{{ __('app.activity_logs') }}</span>
                            </a>
                        @endif
                    </nav>
                </div>

                <div class="gsm-sidebar-footer">
                    <p class="font-semibold">
                        {{ __('app.inventory_monitoring') }}
                    </p>

                    <span>
                        {{ __('app.inventory_monitoring_desc') }}
                    </span>
                </div>
            </aside>

            <div id="sidebar-overlay" class="gsm-sidebar-overlay"></div>

            <div class="gsm-main">
                <header class="gsm-topbar">
                    <button
                        type="button"
                        id="sidebar-toggle"
                        class="gsm-sidebar-toggle"
                        aria-label="Toggle sidebar"
                        aria-expanded="true"
                    >
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="gsm-page-title">
                        @isset($header)
                            {{ $header }}
                        @else
                            <h2>{{ __('app.dashboard') }}</h2>
                        @endisset
                    </div>

                    <div class="gsm-top-actions">
                        @php
                            $user = auth()->user();

                            $avatarUrl = $user->profile_photo_url ?? null;

                            if (!$avatarUrl && !empty($user->profile_photo_path)) {
                                $avatarUrl = \Illuminate\Support\Facades\Storage::url($user->profile_photo_path);
                            }

                            $initial = strtoupper(substr($user->name, 0, 1));
                        @endphp


                        <form
                            method="GET"
                            action="{{ route('search.index') }}"
                            class="gsm-search hidden md:flex"
                            role="search"
                        >
                            <button
                                type="submit"
                                class="gsm-search-submit"
                                aria-label="{{ __('app.search') }}"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.35-4.35"></path>
                                </svg>
                            </button>

                            <input
                                type="search"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('app.global_search_placeholder') }}"
                                autocomplete="off"
                            >
                        </form>

                        <form
                            method="GET"
                            action="{{ route('search.index') }}"
                            class="flex items-center gap-2 rounded-full border border-slate-200 bg-white/90 px-3 py-1.5 shadow-sm"
                        >
                            <button
                                type="submit"
                                class="text-slate-500 hover:text-red-600"
                                aria-label="{{ __('app.search') }}"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </button>

                            <input
                                type="search"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('app.global_search_placeholder') }}"
                                autocomplete="off"
                                class="w-46 border-0 bg-transparent text-sm font-semibold text-slate-700 placeholder:text-slate-400 focus:ring-0"
                            >
                        </form>

                        <div class="gsm-profile-menu">
                            <button
                                type="button"
                                id="profile-menu-button"
                                class="gsm-profile-menu-button"
                                aria-label="Open user menu"
                                aria-expanded="false"
                            >
                                @if($avatarUrl)
                                    <img
                                        src="{{ $avatarUrl }}"
                                        alt="{{ $user->name }}"
                                        onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                                    >

                                    <span class="gsm-profile-initial hidden">
                                        {{ $initial }}
                                    </span>
                                @else
                                    <span class="gsm-profile-initial">
                                        {{ $initial }}
                                    </span>
                                @endif
                            </button>

                            <div id="profile-menu-dropdown" class="gsm-profile-dropdown hidden">
                                <div class="gsm-profile-dropdown-header">
                                    @if($avatarUrl)
                                        <img
                                            src="{{ $avatarUrl }}"
                                            alt="{{ $user->name }}"
                                            onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                                        >

                                        <span class="gsm-profile-initial hidden">
                                            {{ $initial }}
                                        </span>
                                    @else
                                        <span class="gsm-profile-initial">
                                            {{ $initial }}
                                        </span>
                                    @endif

                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <small>{{ $user->email }}</small>
                                    </div>
                                </div>

                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="gsm-profile-dropdown-item"
                                >
                                    <span>☻</span>
                                    {{ __('app.profile') }}
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="gsm-profile-dropdown-item danger"
                                    >
                                        <span>↪</span>
                                        {{ __('app.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="gsm-content">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <div
            id="confirm-modal"
            class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-sm items-center justify-center z-50 px-4"
        >
            <div class="gsm-modal-card">
                <div class="gsm-modal-icon">
                    !
                </div>

                <h3>
                    {{ __('app.confirm_action') }}
                </h3>

                <p id="confirm-message">
                    {{ __('app.confirm_default_message') }}
                </p>

                <div class="flex justify-end gap-2 mt-6">
                    <button
                        type="button"
                        onclick="closeConfirmModal()"
                        class="gsm-button-secondary"
                    >
                        {{ __('app.cancel') }}
                    </button>

                    <button
                        type="button"
                        onclick="submitConfirmForm()"
                        class="gsm-button-danger"
                    >
                        {{ __('app.yes_continue') }}
                    </button>
                </div>
            </div>
        </div>

        <script>
            let selectedFormId = null;

            function openConfirmModal(message, formId) {
                selectedFormId = formId;

                const confirmMessage = document.getElementById('confirm-message');
                const confirmModal = document.getElementById('confirm-modal');

                if (confirmMessage && confirmModal) {
                    confirmMessage.textContent = message || @json(__('app.confirm_default_message'));
                    confirmModal.classList.remove('hidden');
                    confirmModal.classList.add('flex');
                }
            }

            function closeConfirmModal() {
                selectedFormId = null;

                const confirmModal = document.getElementById('confirm-modal');

                if (confirmModal) {
                    confirmModal.classList.add('hidden');
                    confirmModal.classList.remove('flex');
                }
            }

            function submitConfirmForm() {
                if (!selectedFormId) {
                    return;
                }

                const form = document.getElementById(selectedFormId);

                if (form) {
                    form.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const body = document.body;

                const themeToggle = document.getElementById('theme-toggle');
                const themeIcon = document.getElementById('theme-toggle-icon');
                const themeLabel = document.getElementById('theme-toggle-label');

                const sidebarToggle = document.getElementById('sidebar-toggle');
                const sidebarOverlay = document.getElementById('sidebar-overlay');

                const profileMenuButton = document.getElementById('profile-menu-button');
                const profileMenuDropdown = document.getElementById('profile-menu-dropdown');

                const darkModeText = @json(__('app.dark_mode'));
                const lightModeText = @json(__('app.light_mode'));

                function isMobileView() {
                    return window.innerWidth < 768;
                }

                function isDarkMode() {
                    return document.documentElement.classList.contains('dark');
                }

                function updateThemeButton() {
                    const dark = isDarkMode();

                    if (themeIcon) {
                        themeIcon.textContent = dark ? '☀' : '☾';
                    }

                    if (themeLabel) {
                        themeLabel.textContent = dark ? lightModeText : darkModeText;
                    }

                    if (themeToggle) {
                        themeToggle.setAttribute(
                            'title',
                            dark ? lightModeText : darkModeText
                        );

                        themeToggle.setAttribute(
                            'aria-label',
                            dark ? 'Switch to light mode' : 'Switch to dark mode'
                        );
                    }
                }

                function updateSidebarButton() {
                    if (!sidebarToggle) {
                        return;
                    }

                    const expanded = isMobileView()
                        ? body.classList.contains('gsm-mobile-sidebar-open')
                        : !body.classList.contains('gsm-sidebar-collapsed');

                    sidebarToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
                }

                function closeProfileMenu() {
                    if (!profileMenuButton || !profileMenuDropdown) {
                        return;
                    }

                    profileMenuDropdown.classList.add('hidden');
                    profileMenuButton.setAttribute('aria-expanded', 'false');
                }

                updateThemeButton();

                if (themeToggle) {
                    themeToggle.addEventListener('click', function () {
                        document.documentElement.classList.toggle('dark');

                        localStorage.setItem(
                            'theme',
                            isDarkMode() ? 'dark' : 'light'
                        );

                        updateThemeButton();
                    });
                }

                if (localStorage.getItem('sidebar') === 'collapsed' && !isMobileView()) {
                    body.classList.add('gsm-sidebar-collapsed');
                }

                updateSidebarButton();

                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', function () {
                        if (isMobileView()) {
                            body.classList.toggle('gsm-mobile-sidebar-open');
                        } else {
                            body.classList.toggle('gsm-sidebar-collapsed');

                            localStorage.setItem(
                                'sidebar',
                                body.classList.contains('gsm-sidebar-collapsed')
                                    ? 'collapsed'
                                    : 'expanded'
                            );
                        }

                        updateSidebarButton();
                    });
                }

                if (sidebarOverlay) {
                    sidebarOverlay.addEventListener('click', function () {
                        body.classList.remove('gsm-mobile-sidebar-open');
                        updateSidebarButton();
                    });
                }

                if (profileMenuButton && profileMenuDropdown) {
                    profileMenuButton.addEventListener('click', function (event) {
                        event.stopPropagation();

                        const isOpen = !profileMenuDropdown.classList.contains('hidden');

                        profileMenuDropdown.classList.toggle('hidden', isOpen);

                        profileMenuButton.setAttribute(
                            'aria-expanded',
                            isOpen ? 'false' : 'true'
                        );
                    });

                    profileMenuDropdown.addEventListener('click', function (event) {
                        event.stopPropagation();
                    });

                    document.addEventListener('click', closeProfileMenu);

                    document.addEventListener('keydown', function (event) {
                        if (event.key === 'Escape') {
                            closeProfileMenu();
                        }
                    });
                }

                window.addEventListener('resize', function () {
                    if (!isMobileView()) {
                        body.classList.remove('gsm-mobile-sidebar-open');
                    }

                    updateSidebarButton();
                });
            });
        </script>
    </body>
</html>
