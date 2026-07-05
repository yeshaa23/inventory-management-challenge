<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Telkomsel Inventory') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-slate-900 antialiased">
        @php
            $isRegisterPage = request()->routeIs('register');
            $isLoginPage = request()->routeIs('login');
        @endphp

        <div class="gsm-auth-page">
            <div class="gsm-auth-left">
                <div class="gsm-auth-brand">
                    <div class="gsm-auth-logo-mark">
                        <img
                            src="{{ asset('images/telkomsel-logo.png') }}"
                            alt="Telkomsel Logo"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='grid';"
                        >

                        <span class="gsm-auth-logo-fallback" style="display: none;">
                            T
                        </span>
                    </div>

                    <div>
                        <h1>Telkomsel Inventory</h1>
                        <p>{{ __('app.auth_brand_desc') }}</p>
                    </div>
                </div>

                <div class="gsm-auth-hero">
                    <span class="gsm-auth-badge">
                        {{ __('app.inventory_center') }}
                    </span>

                    <h2>
                        {{ $isRegisterPage ? __('app.auth_register_hero_title') : __('app.auth_hero_title') }}
                    </h2>

                    <p>
                        {{ $isRegisterPage ? __('app.auth_register_hero_desc') : __('app.auth_hero_desc') }}
                    </p>
                </div>

                <div class="gsm-auth-features">
                    <div>
                        <strong>{{ __('app.inventory_tracking') }}</strong>
                        <span>{{ __('app.inventory_tracking_desc') }}</span>
                    </div>

                    <div>
                        <strong>{{ __('app.borrowing_management') }}</strong>
                        <span>{{ __('app.borrowing_management_desc') }}</span>
                    </div>

                    <div>
                        <strong>{{ __('app.reports') }}</strong>
                        <span>{{ __('app.reports_desc_short') }}</span>
                    </div>
                </div>
            </div>

            <div class="gsm-auth-right">
                <div class="gsm-auth-card">
                    <div class="gsm-auth-card-header">
                        <h2>
                            {{ $isRegisterPage ? __('app.create_account') : __('app.welcome_back') }}
                        </h2>

                        <p>
                            {{ $isRegisterPage ? __('app.register_desc') : __('app.login_desc') }}
                        </p>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
