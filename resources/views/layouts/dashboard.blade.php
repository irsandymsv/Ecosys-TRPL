<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/open-iconic/font/css/open-iconic-bootstrap.css') }}">

    <title>@yield('judul')</title>
    <style type="text/css">
    	.kepala{
    		padding: 15px;
    		background-color: lime; 
    		overflow: hidden;
    	}

    	.col-3{
    		background-color: rgb(90,90,90);
    	}

    	.col-9{
    		background-color: green;
    	}

    	.side-atas{
    		padding: 15px;
    	}

    	.side-bawah{
    		padding: 15px;
    	}

      @yield('gaya')
	</style>
  </head>
  <body>

  	<div class="content">
      <div class="kepala">
        <h1>ECOSYS</h1>
      </div>

  		<div class="row">
  			<div class="col-3">

  				<div class="side-atas">
  					@yield('side-atas')
  				</div>

  				<div class="side-bawah">
  					@yield('side-bawah')
  				</div>

  			</div>

  			<div class="col-9">
  				@yield('isi1')
  			</div>

  		</div>		
  	</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>