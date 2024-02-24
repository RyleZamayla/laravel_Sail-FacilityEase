<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Facility Ease | Smart Reservation System') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/FacilityEaseLogo-BG-round.png') }}" />


    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @stack('styles')


</head>

<body class="font-sans">
    <div class="min-h-screen flex flex-col justify-center items-center"
        style="background-image: url('{{ asset('images/mainBackgroundFacilityease.png') }}'); background-size: cover; background-position: center;">

        <div class="flex w-full intems-center justify-center m-0">
            {{ $slot }}
        </div>
    </div>
</body>

@stack('scripts')

</html>
