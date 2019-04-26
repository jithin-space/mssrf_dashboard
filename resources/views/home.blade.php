<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
        	<link type="text/css" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>

        <!-- Styles -->
        <style>
            /* html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
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
            } */
        </style>
    </head>
    <body>
      <div class="container-fluid">
        <div class="card-deck">
          <div class="card bg-white">
            <div class="card-body text-center">
              <a href="{{route('datapoints.index')}}">DataPoints:{{$data['datapoints']}}</a>
            </div>
          </div>
          <div class="card bg-white">
            <div class="card-body text-center">
               <a href="{{route('crops.index')}}">Crops: {{$data['crops']}}</a>
            </div>
          </div>
          <div class="card bg-white">
            <div class="card-body text-center">
               <a href="{{route('varieties.index')}}">Varieties: {{$data['varieties']}}</a>
            </div>
          </div>
        </div>
      </div>
        <div class="flex-center position-ref full-height">


            <div class="content">
              <div class="title m-b-md">
                  Biodiversity Survey Mssrf
              </div>

                <div class="row">
                 <div class="col">
                   <div class="title m-b-md">
                       <a href="{{route('datapoints.index')}}">DataPoints:{{$data['datapoints']}}</a>
                   </div>
                 </div>
                 <div class="col">
                   <div class="title m-b-md">
                       <a href="{{route('crops.index')}}">Crops: {{$data['crops']}}</a>
                   </div>
                 </div>
                 <div class="col">
                   <div class="title m-b-md">
                         <a href="{{route('varieties.index')}}">Varieties: {{$data['varieties']}}</a>
                   </div>
                 </div>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    </body>
</html>
