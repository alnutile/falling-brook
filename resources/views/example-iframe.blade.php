<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="font-sans antialiased bg-gray-100 h-full">
        <div class="flex flex-col gap-4 mx-auto p-6">
            <h1>Example Iframe</h1>
            <div class="flex min-h-screen">
                <iframe 
                width="400px"
                src="{{ env('IFRAME_EXAMPLE') }}">
                </iframe>
            </div>
        </div>
    </body>
    @include('shared.ga')
</html>
