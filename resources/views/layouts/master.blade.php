<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Supply Side Platform</title>

        <!-- Scripts -->
        <script src="{{ asset('js/bootstrap.bundle.min.js')}}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    </head>
    <body>

        <header class="p-3 mb-2 bg-primary text-white"><h3 class="h3">Supply Side Platform</h3></header>

        <div class="container">
            @yield('contents')
        </div>

        
        @yield('js_1')

        <script src="{{ mix('js/app.js')}}"></script>
    </body>
</html>
