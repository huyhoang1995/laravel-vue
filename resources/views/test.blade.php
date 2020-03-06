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
    <style type="text/css">
		.video-call-small {
			position: relative;
			width: 200px;
			height: 200px;
		}
		.view-call-main{
		    position: absolute;
			top: 20px;
			right: 20px;
			width: 200px;
			height: 200px;
            /* width:100%;
			min-height: 100vh; */
		}
        .participant-overview{
            /* background:red; */
            /* height:auto; */
	        position: absolute; 
			bottom: -30px;
			right: 20px;
        }
		.button-box{
			position: absolute;
			left: 43%;
			bottom: 0;
		}
		.button-box > i{
			font-size:20px;
			margin-left:15px;
		}
		.main-video-call{
			width: 80%;
            min-height: 100vh;
            margin:0 auto;
            border: 1px solid black;
		}
        .view-call-main-big{
            width:100%;
			height: 100%; 
			 /* min-height: 100vh;  */
             position:absolute; 
        }
        .background-black{
            background:#000 !important;
        }
        .overlay-background{
            background:#000 !important;
            opacity: 0.4;
        }
        .chat-box{
            background-color: rgba(22,38,55,.8);
            box-sizing: border-box;
            color: #FFF;
            display: flex;
            flex-direction: column;
            height: calc(100% - calc(40px + 24px));
            left: 0;
            overflow: hidden;
            position: fixed;
            top: 0;
            transition: left .5s;
            width: 375px;
            z-index: 300;
        }
        .show-chat-box{
            width:375px !important;
        }
        .icon-slash-micro{
            position: absolute;
            top: 5px;
            right: 5px;
            color: #fff;
            font-size: 15px;
        }
        .icon-hand{
            position: absolute;
            top: 5px;
            left: 5px;
            color: #fff;
            font-size: 15px;
        }
        .hide-class{
            display:none !important;
        }
        .boxShadow{
            -webkit-box-shadow: 0px 0px 5px 6px rgba(191,185,191,1) !important;
            -moz-box-shadow: 0px 0px 5px 6px rgba(191,185,191,1) !important;
            box-shadow: 0px 0px 5px 6px rgba(191,185,191,1) !important;
        }
        .modalCall{
            -webkit-animation-duration: 1.2s !important;
            duration:1.2s !important;
            transition-duration: 2s !important;
        }
	</style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



</head>

<body >
    <div id="app">
        <div>
         
            <div>
                <my-login-component ></my-login-component>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="participant-overview"></div>

    </div>

        <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="/__/firebase/7.9.3/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="/__/firebase/7.9.3/firebase-analytics.js"></script>

    <!-- Initialize Firebase -->
    <script src="/__/firebase/init.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- <script src="{{ url('') }}/strophe/strophe.js"></script>
    <script src="{{ url('') }}/strophe/strophe.disco.min.js?v=1"></script> -->
    <script src="{{ url('') }}/lib-jitsi-meet.min.js"></script>

    <script src="{{ url('/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ url('/js/app.js')}}"></script>

    @includeif('partial._default_js')
    @includeif('partial._js')
    
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-i18n/dist/vue-i18n.js"></script>

    

</body>

</html>

<script>


</script>
