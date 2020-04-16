<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <link rel="icon" type="image/png" href="{!! asset('img/SOFTWARE-ICON.ico') !!}"/>
    <title> @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('css')

</head>
<body>
    <div id="app">
        

        <main class="py-4">
            @yield('content')
            
            
        </main>
    </div>
</body>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.tableTotal.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/material.min.js') }}"></script>
    <script src="{{ asset('js/ripples.min.js') }}"></script>
    {{-- <script src="{{ asset('js/geocomplete.js') }}"></script> --}}

    <script>
        $.material.init()
    </script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

    @yield('script')
</html>
