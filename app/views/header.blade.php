<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @section('title')
        商品管理系统
        @show
    </title>

    <!-- Core CSS - Include with every page -->
    <link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">
    <link href="{{{ asset('assets/font-awesome/css/font-awesome.css') }}}" rel="stylesheet">

    <!-- Admin CSS - Include with every page -->
    <link href="{{{ asset('assets/css/admin.css') }}}" rel="stylesheet">

    @yield('styles_src')


    @section('styles')
    <style>
    </style>
    @show


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

</head>

<body>
