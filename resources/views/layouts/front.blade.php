<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>forum</title>


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	
	<link rel="stylesheet" href="{{asset('css/main.css')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.min.css"> 
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	

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

    <style>
    body {
    	font-size: 20px;
	}
	.btn{
		font-size: 15px;
	}
	.content-heading{
		font-size: 30px;
	}
	.modal 
	{ 
		width: 30% !important ;
		max-height: 34% !important ;
		overflow-y: hidden !important ;
	}
	.liked{
	    background:green;
	}
	</style>
</head>
<body>
<header>
   @include('includes.header')
</header>


@yield('banner')

<div class="container">
	
	<br>
	@include('layouts.partials.error')
	@include('layouts.partials.success')
	
	<div class="row">
		
		@section('category')
			@include('layouts.partials.categories')
		@show

		<div class="col-md-9">
			<div class="row content-heading"><h1>@yield('heading')</h1></div>
			<div class="content-wrap">
				@yield('content')
			</div>
		</div>
	</div>
	<br>
</div>

@include('includes.footer')


<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
{{--<!-- Latest compiled and minified JS -->--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('js')
</body>
</html>