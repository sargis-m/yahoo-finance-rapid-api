<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>

