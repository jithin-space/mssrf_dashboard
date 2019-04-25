<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Kappi</title>

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
		background-image: url('images/background.jpg');
		background-size: cover;
		backface-visibility: hidden;
	}

	.main{
		display:block;
	}

    .map {
    	display:inline-block;
      width:50%;
      height:90vh;
			border-box:border-box;
			padding:2em;
    }

		.right{
			display:inline-block;
			position:relative;
			width:45%;
		}
    .pie {
    	display:block;
    	width:100%;
			height:70vh;
			padding:4em;

			box-sizing:border-box;

			top: 10vh;
			padding-left: 2vw;
			position:absolute;
    }


		.rowChart {
			display:block;
			/*width:100%;*/
			min-height:10vh;
			padding:2em;
			box-sizing:border-box;
			position:absolute;

		}


  </style>
</head>
<body>


<div >
	<div class="row main">

		<div class="map">

		</div>

		<div>
			<div class="right">

				<div class="rowChart">

				</div>
				<div class="pie">

				</div>
			</div>
		</div>



	</div>


</div>



<script type="text/javascript" src="{{asset('js/d3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/crossfilter.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dc.js')}}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.js')}}"></script>
<script src="{{asset('js/colorbrewer.js')}}"></script>

<!--Optional-->
<script type="text/javascript" src="{{asset('js/leaflet.markercluster.js')}}"></script>

<script type="text/javascript" src="{{asset('js/dc.leaflet.js')}}"></script>

<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">

  /*     Markers      */





 var data = {!! json_encode($data->toArray()) !!}

 function drawMarkerArea(data) {

		console.log(data);
		 var xf = crossfilter(data);
		 var groupname = "marker-area";
		 var facilities = xf.dimension(function(d) { return d.geolocation.latitude+","+d.geolocation.longitude });

		 var facilitiesGroup = facilities.group();

		 // console.log(facilitiesGroup.all());
		 // var facilitiesGroup = facilities.group().reduce(
			// 	 function(p, v) {
			// 			 (p['varieties']= p['varieties']||[]).push(v.variety);
			// 			 p.variety = v.variety;
			// 			 ++p.count;
			// 			 return p;
			// 	 },
			// 	 function(p, v) {
			// 			 --p.count;
			// 			 return p;
			// 	 },
			// 	 function() {
			// 			 return {count: 0};
			// 	 }
		 //
		 //
		 //
		 // );

		 var marker = dc_leaflet.markerChart(".map",groupname)
				 .dimension(facilities)
				 .group(facilitiesGroup)
				 .center([11.79056,75.99561])
				 .zoom(11)
				 .renderPopup(true)
        	.filterByArea(true);

		//  var types = xf.dimension(function(d) { return d.variety; });
		//
		var panchayath = xf.dimension(function(d){ return d.pt});
		//  var typesGroup = types.group();
		//
		 var pie = dc.pieChart(".pie",groupname)
				 .dimension(panchayath)
				 .group(panchayath.group())
				.slicesCap(26)
				.innerRadius(100)
				.legend(dc.legend().autoItemWidth(true).gap(7).x(500))
				.on('pretransition',function(chart){
					chart.selectAll('text.pie-slice').text(function(d) {
							return d.data.key + ' ' + dc.utils.printSingleValue((d.endAngle - d.startAngle) / (2*Math.PI) * 100) + '%';
					})
				})
				 .renderLabel(true)
				 .renderTitle(true)
				 .ordering(function (p) {
						 return -p.value;
				 });
		//
		// 	var height = 0;
		// 	var hAll = panchayath.group().all().length;
		//
		// var row = dc.rowChart(".rowChart",groupname)
		// 			.width(300)
		// 			.height(hAll*20)
		// 			.dimension(panchayath)
		// 			.group(panchayath.group())
		// 			.ordering(function (p) {
		// 				return -p.value;
		// 			})
		// 	 .elasticX(true);

		 dc.renderAll(groupname);
		 return {marker: marker};
 }


 drawMarkerArea(data);






</script>

</body>
</html>
