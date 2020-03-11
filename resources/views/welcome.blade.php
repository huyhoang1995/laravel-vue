<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Product" prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/html">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var siteUrl = '{!! url("/") !!}';
    </script>
    <link rel="icon" href="{{ url('/logoIcon.jpg')}}" type="image/jpg" sizes="16x16">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/backend.css')}}" />


    @includeif('partial._default_css')
    @includeif('partial._css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



</head>

<body class=" pace-done">
    <div id="app">
        <div id="container" class="effect aside-float aside-bright mainnav-lg">
            @includeif('partial._header')
            @includeif('partial._menu')
            <div>
                <div class="col-md-12" id="content-container">
                     <router-view></router-view> 
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="{{ url('') }}/strophe/strophe.js"></script>
    <script src="{{ url('') }}/strophe/strophe.disco.min.js?v=1"></script>
    <script src="{{ url('') }}/lib-jitsi-meet.min.js"></script>

    <script src="{{ url('/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ url('/js/app.js')}}"></script>

    @includeif('partial._default_js')
    @includeif('partial._js')
    
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-i18n/dist/vue-i18n.js"></script>
    

</body>
<script>
</script>
</html>