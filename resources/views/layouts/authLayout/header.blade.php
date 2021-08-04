<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>NSTI CALICUT</title>
        <link rel="icon" href="/assets/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/style.css" >
        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

<!--from auth app.blade-->
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


{{-- AFTER COMMENTING THIS ,THE CSS STYLE LOAD ISSUE FIXED @ 15/16/2021 1:26PM --}}
    {{-- <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
{{-- AFTER COMMENTING THIS ,THE CSS STYLE LOAD ISSUE FIXED @ 15/16/2021 1:26PM --}}

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">


    </head>

    <body>
        <div class="container-fluid" id="header-container">
            <div class="logo-images">
                <img src="/assets/images/test.png" class="img-fluid" alt="Responsive image" />

            </div>
