<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    @vite('resources/css/app.css')
</head>
<body class="font-sans">
@include('layouts.icons') {{-- SVG іконки --}}
<div id="app" class="min-h-screen w-full flex">
    @yield('sidebar')
    <div class="flex-1 flex flex-col">
        @yield('header')

        @yield('content')
    </div>
</div>

@stack('scripts')
<script src="{{ asset('js/components/form/numberInput.js') }}"></script>
</body>
</html>
