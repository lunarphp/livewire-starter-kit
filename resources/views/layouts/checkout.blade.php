<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="An ecommerce storefront built with Zabrdast.">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <!-- <link rel="manifest" href="/site.webmanifest"> -->
    <!-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.svg') }}">
    <!-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    @livewireStyles
    @stripeScripts
</head>

<body class="antialiased text-gray-900">
    <header class="relative border-b border-gray-100">
        <div class="flex items-center h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
            <a class="flex items-center flex-shrink-0" href="{{ url('/') }}">
                <span class="sr-only">Home</span>
                <x-brand.logo class="w-auto h-6 text-gray-500" />
            </a>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts
</body>

</html>
