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
        <div class="gsm-auth-page">
            <div class="gsm-auth-left">
                <div class="gsm-auth-brand">
                    <div class="gsm-logo-mark">T</div>

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
                        {{ __('app.auth_hero_title') }}
                    </h2>

                    <p>
                        {{ __('app.auth_hero_desc') }}
                    </p>
                </div>

                <div class="gsm-auth-features">
                    <div>
                        <strong>{{ __('app.role_access') }}</strong>
                        <span>{{ __('app.role_access_desc') }}</span>
                    </div>

                    <div>
                        <strong>{{ __('app.inventory_tracking') }}</strong>
                        <span>{{ __('app.inventory_tracking_desc') }}</span>
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
                        <h2>{{ __('app.welcome_back') }}</h2>
                        <p>{{ __('app.login_desc') }}</p>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
