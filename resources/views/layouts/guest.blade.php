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
                        <p>Internal Asset Management System</p>
                    </div>
                </div>

                <div class="gsm-auth-hero">
                    <span class="gsm-auth-badge">
                        Inventory Center
                    </span>

                    <h2>
                        One dashboard for all your inventory needs
                    </h2>

                    <p>
                        Kelola data barang, kategori, peminjaman, pengembalian,
                        serta laporan inventaris dalam satu sistem yang rapi dan terkontrol.
                    </p>
                </div>

                <div class="gsm-auth-features">
                    <div>
                        <strong>Role Access</strong>
                        <span>Admin, Staff, dan Manager</span>
                    </div>

                    <div>
                        <strong>Inventory Tracking</strong>
                        <span>Stok, lokasi, kondisi, dan status barang</span>
                    </div>

                    <div>
                        <strong>Reports</strong>
                        <span>Dashboard, export, dan audit log</span>
                    </div>
                </div>
            </div>

            <div class="gsm-auth-right">
                <div class="gsm-auth-card">
                    <div class="gsm-auth-card-header">
                        <h2>Welcome Back</h2>
                        <p>Masuk untuk mengelola inventaris kantor.</p>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
