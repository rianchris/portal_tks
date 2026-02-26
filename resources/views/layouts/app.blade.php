<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo/icon.png') }}" type="image/png">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:400" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 my-4">
        @auth
            <x-navigation-menu />
            <x-breadcrumb />
        @endauth
        {{ $slot }}
    </div>
    {{-- @livewireScripts(['asset_url' => 'http://127.0.0.1:as/vendor/livewire/livewire.js']) --}}
</body>

</html>
