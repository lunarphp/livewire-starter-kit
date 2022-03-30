<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Demo Storefront</title>
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    @livewireStyles
</head>

<body class="antialiased">
    <header class="border-b border-gray-100">
        <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">
            <a href="{{ url('/') }}">
                <x-brand.logo class="h-10" />
            </a>

        </div>
    </header>

    {{ $slot }}

    @livewireScripts
</body>

</html>
