<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '小可Laravel')</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/clean-blog.css') }}">
{{--    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">--}}

    <!-- Custom fonts for this template -->
{{--    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">--}}
{{--    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>--}}
{{--    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>--}}

    <!-- Custom styles for this template -->
{{--    <link href="css/clean-blog.min.css" rel="stylesheet">--}}

</head>

<body>

<!-- Navigation -->
@include('home._nav')

<!-- Page Header -->
@yield('header')


<!-- Main Content -->
@yield('container')

<!-- Footer -->
@include('home._footer')

<!-- Bootstrap core JavaScript -->
{{--<script src="vendor/jquery/jquery.min.js"></script>--}}
<script src="{{ mix('js/app.js') }}"></script>
{{--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

<!-- Custom scripts for this template -->
<script src="{{ asset('js/clean-blog.min.js') }}"></script>
@yield('js')
</body>

</html>

