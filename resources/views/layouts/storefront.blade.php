<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Demo Storefront</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @livewireStyles
    </head>
    <body class="antialiased">
        @livewire('components.navigation')

        {{ $slot }}

        @livewireScripts
    </body>
</html>
