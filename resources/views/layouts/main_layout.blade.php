<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Chart javascript library-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <style type="text/css">
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }
            .sidenav, #sidenav-overlay {
                top: 65px;
                height: 65%;
            }


            /*.divider {
                margin: 0.5em 0 0.5em 0;
                border: 0;
                height: 1px;
                width: 100%;
                display: block;
                background-color: blue;
                background-image: linear-gradient(to right,pink,blue,pink);
            }*/
        </style>
  @yield('style')
</head>
<body>
    <header>
       @include('includes.header')
   </header>
   <main>
           @yield('content')
   </main>
       @include('includes.footer')

   @yield('scripts')
</body>
</html>
