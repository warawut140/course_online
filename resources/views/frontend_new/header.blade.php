<link rel="icon" href="">
<title>{{ config('app.title', 'ครอบครัวเพื่อไทย') }}</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link type="image/ico" rel="shortcut icon" href="{{ asset('image/faviconx.ico') }}" sizes="32x32">
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon -->
{{-- <link rel="shortcut icon" href="{{asset('./favicon.png')}}"> --}}


<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Lora:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Nunito:wght@400;700&display=swap"
    rel="stylesheet">

<!-- Libs CSS -->
<link rel="stylesheet" href="{{ asset('./assets/fonts/fontawesome/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/aos/dist/aos.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/flickity-fade/flickity-fade.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/flickity/dist/flickity.min.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/highlightjs/styles/vs2015.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/jarallax/dist/jarallax.css') }}">
<link rel="stylesheet" href="{{ asset('./assets/libs/quill/dist/quill.core.css') }}" />

<!-- Map -->
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('./assets/css/theme.min.css') }}">

<link href="https://fonts.googleapis.com/css?family=Kanit:300,400,500" rel="stylesheet">

<!--ICON-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'
    integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">

<title>Skola Home v9</title>

<style>
    .vl {
        border-left: 2px solid gray;
        height: 30px;
    }

    .buttonred {
        background-color: while;
        border: 1px solid red;
        font-size: 0.9em;
        padding: 8px 10px;

        border-radius: 50px;

    }

    .loader {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        z-index: 9999;

        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid rgb(190, 33, 33);
        border-bottom: 16px solid rgb(196, 47, 47);
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .bg-footer {
        --bs-bg-opacity: 1;
        background-color: #8B0900;
    }

    .overlay-custom-left::before {
        background: -webkit-gradient(linear, left bottom, left top, from(rgba(9, 7, 97, .6)), to(rgba(9, 7, 97, .6))), -webkit-gradient(linear, right top, left top, color-stop(17.76%, #8B0900), to(rgba(255, 255, 255, 0)));
        background: linear-gradient(0deg, rgba(9, 7, 97, .6), rgba(9, 7, 97, .6)), linear-gradient(270deg, #8B0900 17.76%, rgba(255, 255, 255, 0) 100%);
    }

    .text-white-800 {
        color: #ffffff !important;
    }


    body {
        font-family: 'Kanit', sans-serif;
        /* font-size: 14px; */
        /* background-color: #8B0900; */
        /* background-image: url("{{ asset('image/bg.png') }}"); */
    }
</style>
