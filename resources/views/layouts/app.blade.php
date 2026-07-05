<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Telkomsel Inventory') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

        <script>
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased text-slate-900 dark:text-white">
        <div class="gsm-shell">
            <aside class="gsm-sidebar hidden lg:flex">
                <div>
                    <div class="gsm-brand-card">
                        <div class="gsm-logo-mark">T</div>
                        <div>
                            <h1>Telkomsel</h1>
                            <p>Inventory Center</p>
                        </div>
                    </div>

                    <div class="gsm-user-mini">
                        <div class="gsm-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="gsm-user-name">{{ auth()->user()->name }}</p>
                            <p class="gsm-user-role">{{ auth()->user()->role->name ?? 'User' }}</p>
                        </div>
                    </div>

                    <nav class="gsm-nav">
                        <p class="gsm-nav-title">Menu Utama</p>

                        <a href="{{ route('dashboard') }}"
                            class="gsm-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <span class="gsm-nav-icon">⌂</span>
                            <span>Dashboard</span>
                        </a>

                        @if(auth()->user()->hasRole(['Admin', 'Staff']))
                            <a href="{{ route('categories.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                <span class="gsm-nav-icon">▦</span>
                                <span>Kategori</span>
                            </a>

                            <a href="{{ route('products.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                                <span class="gsm-nav-icon">◈</span>
                                <span>Barang</span>
                            </a>

                            <a href="{{ route('borrowings.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
                                <span class="gsm-nav-icon">↔</span>
                                <span>Peminjaman</span>
                            </a>
                        @endif

                        @if(auth()->user()->hasRole(['Admin', 'Manager']))
                            <a href="{{ route('reports.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                                <span class="gsm-nav-icon">▤</span>
                                <span>Laporan</span>
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('Admin'))
                            <a href="{{ route('activity-logs.index') }}"
                                class="gsm-nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                                <span class="gsm-nav-icon">◎</span>
                                <span>Riwayat Aktivitas</span>
                            </a>
                        @endif
                    </nav>
                </div>

                <div class="gsm-sidebar-footer">
                    <p class="font-semibold">Inventory Monitoring</p>
                    <span>Kelola aset kantor secara cepat, rapi, dan terkontrol.</span>
                </div>
            </aside>

            <div class="gsm-main">
                <header class="gsm-topbar">
                    <div class="gsm-page-title">
                        @isset($header)
                            {{ $header }}
                        @else
                            <h2>Dashboard</h2>
                        @endisset
                    </div>

                    <div class="gsm-top-actions">
                        <div class="gsm-search hidden md:flex">
                            <span>⌕</span>
                            <input type="text" placeholder="Search inventory" readonly>
                        </div>

                        <button type="button" id="theme-toggle" class="gsm-icon-button">
                            <span id="theme-toggle-text">Dark Mode</span>
                        </button>

                        <a href="{{ route('profile.edit') }}" class="gsm-profile-pill">
                            <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            <strong>{{ auth()->user()->name }}</strong>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="gsm-logout-button">
                                Logout
                            </button>
                        </form>
                    </div>
                </header>

                <div class="gsm-mobile-nav lg:hidden">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>

                    @if(auth()->user()->hasRole(['Admin', 'Staff']))
                        <a href="{{ route('categories.index') }}"
                            class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            Kategori
                        </a>

                        <a href="{{ route('products.index') }}"
                            class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                            Barang
                        </a>

                        <a href="{{ route('borrowings.index') }}"
                            class="{{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
                            Peminjaman
                        </a>
                    @endif

                    @if(auth()->user()->hasRole(['Admin', 'Manager']))
                        <a href="{{ route('reports.index') }}"
                            class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                            Laporan
                        </a>
                    @endif
                </div>

                <main class="gsm-content">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <div id="confirm-modal" class="hidden fixed inset-0 bg-slate-950/60 backdrop-blur-sm items-center justify-center z-50 px-4">
            <div class="gsm-modal-card">
                <div class="gsm-modal-icon">!</div>

                <h3>Konfirmasi Aksi</h3>

                <p id="confirm-message">
                    Apakah Anda yakin?
                </p>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeConfirmModal()" class="gsm-button-secondary">
                        Batal
                    </button>

                    <button type="button" onclick="submitConfirmForm()" class="gsm-button-danger">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>

        <script>
            let selectedFormId = null;

            function openConfirmModal(message, formId) {
                selectedFormId = formId;

                document.getElementById('confirm-message').textContent = message;
                document.getElementById('confirm-modal').classList.remove('hidden');
                document.getElementById('confirm-modal').classList.add('flex');
            }

            function closeConfirmModal() {
                selectedFormId = null;

                document.getElementById('confirm-modal').classList.add('hidden');
                document.getElementById('confirm-modal').classList.remove('flex');
            }

            function submitConfirmForm() {
                if (selectedFormId) {
                    document.getElementById(selectedFormId).submit();
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const toggleButton = document.getElementById('theme-toggle');
                const toggleText = document.getElementById('theme-toggle-text');

                function updateThemeText() {
                    if (!toggleText) {
                        return;
                    }

                    toggleText.textContent = document.documentElement.classList.contains('dark')
                        ? 'Light Mode'
                        : 'Dark Mode';
                }

                updateThemeText();

                if (toggleButton) {
                    toggleButton.addEventListener('click', function () {
                        document.documentElement.classList.toggle('dark');

                        localStorage.setItem(
                            'theme',
                            document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                        );

                        updateThemeText();
                    });
                }
            });
        </script>
    </body>
</html>
