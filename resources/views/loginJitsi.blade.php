<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="libs/bootstrap.min.css">
	
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
		.welcome{
			background-image: linear-gradient(-90deg,#1251AE 0,#0074FF 50%,#1251AE 100%);
			display: flex;
			flex-direction: column;
			font-family: inherit;
			justify-content: space-between;
			min-height: 100vh;
			position: relative;
		}
		.box-enter{
			width: 50%;
			margin: 0 auto;
			margin-top: 20%;
		}
	</style>
</head>
<body>
	<div class="welcome">
		<div class="box-enter">
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="" method="POST" role="form">
						<legend class="col-md-12">Start a new meeting</legend>

						<span class="col-md-10">
							<div class="form-group">
								<input type="text" class="form-control" id="" placeholder="Input field">
							</div>
						</span>
						<span class="col-md-2">
							<button type="submit" class="btn btn-primary">Submit</button>
						</span>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="{{ url('/js/app.js')}}"></script>

    @includeif('partial._default_js')
    @includeif('partial._js')
</html>
