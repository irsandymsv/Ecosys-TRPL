<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Ecosys-Masuk</title>
    <style type="text/css">
		body{
			background: url("{{asset('image/village.jpg')}}") no-repeat fixed center;
			background-size: cover;
			padding: 0px;
			margin: 0px;
			font-family: verdana;
			height: 100%;
		}

		.container{
			/*background-color: rgba(140, 210, 42, 0.5);*/
			/*background-color: rgba(240, 240, 240, 0.5);*/
			background-color: rgba(0, 0, 0, 0.5);
			width: 400px;
			min-height: 340px;
			/*border: 1px ;*/
			border-radius: 25px;
			display: block;
			margin-right: auto;
			margin-left: auto;
			margin-top: 10%;
		}

		.forms{
			text-align: center;
			/*padding-top: 5%;*/
			padding-right: 20px;
			margin-left: 20px; 
			color: white;
			
		}

		/*.butt{
			background-color: Blue;
			color: white;
		}

		.butt:hover{
			background-color: lime;
			cursor: pointer;
		}*/
	</style>

  </head>
  <body>
  	    <div class="container">
    		<form class="forms" method="POST" action="{{ route('login') }}">
    		<h1 style="color: rgb(255, 255, 26); font-family: Helvetica;">Log In</h1><br>
    		<div class="form-group">
    			<input class="form-control" type="text" name="nama" value="{{ old('nama') }}" placeholder="Username">
					<?php if ($errors->has('nama')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 1px;">
							{{ $errors->first('nama') }}
						</div>
					<?php endif ?>
    		</div>
			<br>
			<div class="form-group">
				<input class="form-control" type="Password" name="password" placeholder="Password">
					<?php if ($errors->has('password')): ?>
						<div class="alert alert-danger" role="alert" style="padding: 1px;">
							{{ $errors->first('password') }}
						</div>
					<?php endif ?>
			</div>
			<br>

			<input class="btn btn-success" type="submit" name="submit" value="Log in" style="padding: 10px 15px;">
			{{ csrf_field() }}
		</form>	
	</div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js//jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>