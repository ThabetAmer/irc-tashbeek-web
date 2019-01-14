<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tashbeek</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(auth()->check())
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endif

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('./css/app.css')}}">
    <link rel="stylesheet" href="{{asset('./css/style.css')}}">
    <link rel="shortcut icon" href="{{{ asset('img/logo_big.png') }}}">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Work Sans', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="bg-grey-light">
<div class="wrapper bg-grey-lighter ">

    @if(auth()->check())
        @include('layouts.sidebar')
    @endif

    <div class="p-10 container mx-auto px-16 {{!auth()->check()? ' flex items-center' :''}}" id="app">
        @if(auth()->check())
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>

<script type="text/javascript">
    window.appURL = '{{ url('/') }}';

</script>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('minified');
        });
    });
</script>

<script src="{{asset('./js/app.js')}}"></script>


{{--<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}

@section('script')

@show

{{--<script src="{{ asset('js/seekerProfile.js') }}" type="text/javascript"></script>--}}
