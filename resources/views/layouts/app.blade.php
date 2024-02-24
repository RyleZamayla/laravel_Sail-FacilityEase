<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.6/dist/simplebar.min.css" />
    {{-- <link href="https://cdn.tailwindcss.com" rel="stylesheet"> --}}


    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />

    <title>{{ config('app.name', 'Facility Ease | Smart Online Reservation') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/FacilityEaseLogo-BG-round.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')


</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-200">

        <div class="flex-shrink-0 w-64 overflow-y-auto bg-gray-900 scrollbar-none">
            @include('layouts.sidebar')
        </div>

        <div class="flex flex-col flex-1 overflow-hidden">
            <header>
                @include('layouts.header')
            </header>

            <main class="flex-1 overflow-y-auto bg-neutral-100">
                <div class="bg-grey-300 pb-6">
                    @yield('content')
                </div>
            </main>

            <footer class="flex-shrink-0 bg-gray-300">
                @include('layouts.footer')
            </footer>

        </div>

    </div>
</body>

@stack('scripts')

</html>
