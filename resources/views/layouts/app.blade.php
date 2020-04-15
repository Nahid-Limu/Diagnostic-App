<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title> @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <style>
            .searchbar{
            margin-bottom: auto;
            margin-top: auto;
            height: 60px;
            background-color: #353b48;
            border-radius: 30px;
            padding: 10px;
            }
        
            .search_input{
            color: white;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 40px;
            transition: width 0.4s linear;
            color:white; 
            font-size: 20px;
            font: bold;
            }
        
            .searchbar:hover > .search_input{
            padding: 0 10px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
            }
        
            .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
            text-decoration: none;
            }
        
            .search_icon{
            height: 40px;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:white;
            }

            ul {
            list-style-type: none;
            margin-left: 80px;
            width: 530px;
            position: absolute;
            text-align: center;
            background: aqua;
            font-size: 20px;
            font-style: bold;
            border-radius: 25px;
            }
            li:hover{
                background: ;
                border: 3px solid black;
                margin-left: 80px;
                border-radius: 0px 50px 50px 0px;
                animation: shake 0.5s;
                animation-iteration-count: infinite;
                color: black;
            }
            @keyframes shake {
                0% { transform: translate(1px, 1px) rotate(0deg); }
                10% { transform: translate(-1px, -2px) rotate(-1deg); }
                20% { transform: translate(-3px, 0px) rotate(1deg); }
                30% { transform: translate(3px, 2px) rotate(0deg); }
                40% { transform: translate(1px, -1px) rotate(1deg); }
                50% { transform: translate(-1px, 2px) rotate(-1deg); }
                60% { transform: translate(-3px, 1px) rotate(0deg); }
                70% { transform: translate(3px, 1px) rotate(-1deg); }
                80% { transform: translate(-1px, -1px) rotate(1deg); }
                90% { transform: translate(1px, 2px) rotate(0deg); }
                100% { transform: translate(1px, -2px) rotate(-1deg); }
            }

            img {
                border-radius: 50%;
                border: 3px solid black;
                background-color: white;
            }

            #nav{
                background-image: url("img/final-banner.jpg");
                
                background-repeat: no-repeat;
                background-size:cover;
            }

            .ErrorMsg{
                color: red;
            }

            .errorInputBox {
                border: 1px solid red !important;
            }
            
    </style>
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
