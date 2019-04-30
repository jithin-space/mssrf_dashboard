<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Variety</title>

	<meta itemprop="name" content="DC.js + Leaflet"/>
	<meta itemprop="description" content="DC.js + Leaflet chart"/>

	<meta charset="UTF-8">

	<link type="text/css" href="{{asset('css/leaflet.css')}}" rel="stylesheet"/>
	<link type="text/css" href="{{asset('css/MarkerCluster.Default.css')}}" rel="stylesheet"/>
	<link type="text/css" href="{{asset('css/MarkerCluster.css')}}" rel="stylesheet"/>
	<link type="text/css" href="{{asset('css/dc.css')}}" rel="stylesheet"/>
	<link type="text/css" href="{{asset('css/leaflet-legend.css')}}" rel="stylesheet"/>
	<link type="text/css" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>

  <style>

	body{
		background-image: url( "{{asset('images/background.jpg')}}");
		/* background-color: white; */
		background-size: cover;
		backface-visibility: hidden;
	}

	.map  {
		display:block;
		width:100%;
		height:95vh;
		border-box:border-box;
		padding:5em;
    border: 2px solid grey;
    margin: 5px;
	}

  .leaflet-top{
    z-index: 1040 !important;
  }





  </style>
</head>
<body>

<div class="container-fluid">
	<div class="fixed-top">
		<div class="d-flex flex-row-reverse m-2 text-white">
			<div class="p-2 bg-info">Count:[{{$data->count()}}]</div>
		 	<div class="p-2 bg-primary">Item:{{ucfirst($data[0]->variety['name'])}}</div>
		 <div class="p-2 bg-warning ">View:Variety Heat</div>
		</div>
	</div>

	<div class="row ">
		<div id="map" class="col map">

		</div>
	</div>

</div>





<script type="text/javascript" src="{{asset('js/leaflet.js')}}"></script>

<!-- <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> -->

<script type="text/javascript" src="{{asset('js/leaflet.markercluster.js')}}"></script>

<!-- <script type="text/javascript" src="{{asset('js/dc.leaflet.js')}}"></script> -->
<script type="text/javascript" src="{{asset('js/leaflet-heat.js')}}"></script>


<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">

  /*     Markers      */




 var data = {!! json_encode($data->toArray()) !!}

 var testPoints = data.map(function(d){
   return [d.geo.latitude,d.geo.longitude,d.ennam];
 });

 // console.log(test);

 var map = L.map('map').setView([11.77556,75.90561], 10);

 // L.control.layers(layers, basemaps, {position: 'bottomleft'}).addTo(map);

 var tiles = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
 }).addTo(map);

 // addressPoints = addressPoints.map(function (p) { return [p[0], p[1],p[2]]; });

 var heat = L.heatLayer(testPoints, {radius:5, blur: 5 , maxZoom:15 ,gradient: {0.4: 'yellow', 0.65: 'lime', 1: 'green'}}).addTo(map);





</script>

</body>
</html>
