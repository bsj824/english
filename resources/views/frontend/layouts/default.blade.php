<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@section('description')@show">
    <meta name="keywords" content="@section('keywords')@show">
    <title>@section('title')tiny @show</title>
    <link rel="stylesheet" type="text/css" href="{{cdn(mix('static/css/app.css'))}}">
    @yield('css')
</head>
<body>
@yield('content')
<script src="{{cdn(mix('static/js/app.js'))}}"></script>
@yield('js')
@stack('js')
</body>
</html>