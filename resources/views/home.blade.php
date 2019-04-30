<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Biodiversity Survey MSSRF</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        	<link type="text/css" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>

        <!-- Styles -->
        <style>
        body{

          background-color: white;
          background-size: cover;
          backface-visibility: hidden;
        }


        .order-card {
            color: #fff;
            margin-top:20px;
        }

        .bg-c-blue {
            background: linear-gradient(45deg,#4099ff,#73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg,#2ed8b6,#59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg,#FFB64D,#ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg,#FF5370,#ff869a);
        }


        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            /* font-size: 26px; */
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }

        .row a:hover{
          color: #212529;
          text-decoration: none;
        }


        </style>
    </head>
    <body>

      <div class="container-fluid d-flex h-20">
        <div class="row">
          <div class="col-sm-2">
             <img class="img-fluid" src="{{asset('images/logo.jpg')}}" alt="Chania">
          </div>
          <div class="col-sm-8 offset-md-2 justify-content-center align-self-center text-success">
            <h1>Biodiversity Survey MSSRF</h1>
          </div>
        </div>

      </div>
      <div class="container-fluid my-5 text-primary">
        <h2>Survey Dashboard</h2>
        <hr/>
      </div>

      <div class="container">
          <div class="row">
              <div class="col-md-4 col-xl-3">

                  <a href="{{route('datapoints.index')}}" class="card bg-c-blue order-card">
                      <div class="card-block">
                          <h6 class="m-b-20">Data Points</h6>
                          <h2 class="text-right"><i class="fa fa-map-marker fa-lg f-left"></i><span>{{$data['datapoints']}}</span></h2>
                          <p class="m-b-0">Views Available<span class="f-right">1</span></p>
                      </div>
                  </a>

              </div>

              <div class="col-md-4 col-xl-3">
                  <a  href="{{route('crops.index')}}" class="card bg-c-green order-card">
                      <div class="card-block">
                          <h6 class="m-b-20">Crops</h6>
                          <h2 class="text-right"><i class="fa fa-pagelines fa-lg f-left"></i><span>{{$data['crops']}}</span></h2>
                          <p class="m-b-0">Views Available<span class="f-right">2</span></p>
                      </div>
                  </a>
              </div>

              <div class="col-md-4 col-xl-3">
                  <a href="{{route('varieties.index')}}" class="card bg-c-yellow order-card">
                      <div class="card-block">
                          <h6 class="m-b-20">Varieties</h6>
                          <h2 class="text-right"><i class="fa fa-leaf fa-lg f-left"></i><span>{{$data['varieties']}}</span></h2>
                          <p class="m-b-0">Views Available<span class="f-right">3</span></p>
                      </div>
                  </a>
              </div>

              <div class="col-md-4 col-xl-3">
                  <a href="{{route('panchayaths.index')}}" class="card bg-c-pink order-card">
                      <div class="card-block">
                          <h6 class="m-b-20">Panchayaths</h6>
                          <h2 class="text-right"><i class="fa fa-globe f-left"></i><span>26</span></h2>
                          <p class="m-b-0">Views Available<span class="f-right">1</span></p>
                      </div>
                  </a>
              </div>
      	</div>
      </div>
      <footer class="fixed-bottom">
      <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://computingfreedomcollective.com/"> Computing Freedom Collective</a>
      </div>
    </footer>
      <!--  end of jumbotron-->

        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>
