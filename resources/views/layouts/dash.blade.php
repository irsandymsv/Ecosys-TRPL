<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/fontAwe/css/all.css')}}" rel="stylesheet">
    @yield('link ref')
    <title>@yield('judul')</title>
    <style type="text/css">

      .navbar.navbar-default{
        background-color: rgb(175, 194, 112);
        margin: 0px;
        padding: 10px;
        overflow: hidden;
        /*position: fixed;
        top: 0;
        width: 100%;*/
      }

      .col-sm-3{
        background-color: rgb(255,255,255);
        margin-top: 10px;
        padding: 0;
        position: sticky;
        top: 0;
        height: 100%;
        overflow: auto;
      }

      .col-sm-9{
        background-color: rgb(225,225,225);
        /*margin-left: 338px;*/
        /*position: initial;*/
        /*padding: 1px 16px;*/
        min-height: 570px;
      }

      .side-atas{
        padding-left: 15px;
      }

      .side-bawah{
       padding: 10px; 
      }

      .side-bawah a{
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
      }

      .side-bawah a:hover{
        background-color: #555;
        color: white;
      }

      @media screen and (max-width: 700px) {
        .side-bawah {
          width: 100%;
          height: auto;
          position: relative;
        }
        .side-bawah a {float: left; font-size: 18px;}
        div.col-sm-9 {margin-left: 0;}
      }

      @media screen and (max-width: 400px) {
        .side-bawah a {
          text-align: center;
          float: none;
          font-size: 16px;
        }
      }

      .glyphicon.glyphicon-log-out:hover{
        color: rgb(255, 255, 77);
      }

      @yield('gaya')

    </style>

  </head>
  <body>

    <div class="container-fluid">

      <div class="row">

        <div class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <h2 class="navbar-text" style="color: green;"><b>ECOSYS</b></h2>

              <span class="navbar-text navbar-right" style="margin-left: 1050px;">
                <form style="text-align: right;" action="{{ route('logout') }}" method="POST" id="logout-form">
                  @csrf
                  <a class="navbar-link" href="{{ route('logout') }}" id="logout-form" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-out" style="font-size: 28px;"></span></a>  
                </form>
              </span>

            </div>
          </div>
          
          
        </div>


        <div class="col-sm-3">

            <div class="side-atas">
              <h3><span class="glyphicon glyphicon-user" style="margin-right: 20px; color: rgb(
              255, 204, 0);"></span>@yield('nama-user')</h3>
              <p style="margin-left: 55px;">@yield('peran')</p>
             
            </div>

            <div class="side-bawah">
              @yield('side-bawah')
            </div>

        </div>

        <div class="col-sm-9">
          @yield('isi1')
        </div>

      </div>    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js//jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    @yield('script')
  </body>
</html>