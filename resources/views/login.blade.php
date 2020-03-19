<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        var siteUrl = '{!! url("/") !!}';
        var urlAuthorization = "http://auth.newtel.com.vn/authorization";
    </script>
    <link rel="icon" href="{{ url('/img/care4u.png')}}" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css')}}" />

    <script type="text/javascript" src="{{ url('') }}/Nifty/js/jquery.min.js"></script>


    @includeif('partial._default_css')
    @includeif('partial._css')
    @includeif('partial._modalLoader')
</head>
<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="app">
        <div id="container" class="cls-container">

            <!-- BACKGROUND IMAGE -->
            <!--===================================================-->
            <div id="bg-overlay" class="bg-img" style="background-image: url('{{ url('') }}/images/bg-login.jpg');">

            </div>
            <!-- LOGIN FORM -->
            <!--===================================================-->
            <my-login-component></my-login-component>
        </div>
    </div>
    <script src="{{ url('/js/app.js')}}"></script>
    @includeif('partial._default_js')
    @includeif('partial._js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
    <script>
        // var socket = io('http://localhost:3003');
        // console.log(socket);
        // localStorage.setItem("socket", socket);
        // global.dataSocket = socket;


    </script>
</body>

</html>