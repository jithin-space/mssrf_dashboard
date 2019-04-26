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

	.map , .pie {
		display:block;
		width:100%;
		height:90vh;
		border-box:border-box;
		padding:2em;
	}
	.map .dc-leaflet{
		border:2px solid grey;
	}

	.pie{
		margin-top:5vh;
		height:80vh !important;
	}




  </style>
</head>
<body>

<div class="container-fluid">
	<div class="fixed-top">
		<div class="d-flex flex-row-reverse m-2 text-white">
			<div class="p-2 bg-info">Count:[{{$data->count()}}]</div>
		 	<div class="p-2 bg-primary">Item:{{ucfirst($data[0]->variety['name'])}}</div>
		 <div class="p-2 bg-warning ">View:Variety</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 map">

		</div>
		<div class="col-md-6 pie p-5">

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
		 var facilities = xf.dimension(function(d) { return d.geo.latitude+","+d.geo.longitude });

		 // var facilitiesGroup = facilities.group();

		 var max = facilities.group().reduceSum(function (d){
			 return d.ennam;
		 }).top(1)[0].value;

		 var output_range = 100;
		 var icon_min_size=2;

		 if(max < 10){
			 output_range = max*2;
		 }
		 else if(max < 50){
			 output_range = 20;
		 }else if(max < 100){
			 output_range = 40;
		 }else{
			 output_range = 50;
		 }

		 var x = d3.scaleLinear()
    .domain([0, max])
    .rangeRound([0, output_range]);


		var color = d3.scaleLinear()
	 .domain([0, output_range])
	 .range(["red", "white"]);



		var testGroup = facilities.group().reduceSum(function(d){
			return d.ennam;
		});

		// console.log(max);
		// console.log(output_range);
		// console.log(testGroup.all());

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

		 var increment = Math.floor(output_range/10);

		 var marker = dc_leaflet.markerChart(".map",groupname)
				 .dimension(facilities)
				 .group(testGroup)
				 .valueAccessor(d=>d.value)
				 .center([11.79056,75.99561])
				 .zoom(10)
				 .renderPopup(true)
        	.filterByArea(true)
					.icon(function(d) {
              var iconUrl;
							var testValue= Math.ceil(x(d.value)/increment)+icon_min_size;
							// console.log(testValue);
							// console.log(color(testValue-icon_min_size));

							var svg = ' <svg xmlns="http://www.w3.org/2000/svg"><circle cx="'+testValue*2+'" cy="'+testValue*2+'" r="'+testValue*2+'"  stroke="red" fill="'+color(testValue-icon_min_size)+'" fill-opacity="0.9" /></svg> ' ;

							var url = encodeURI("data:image/svg+xml," + svg).replace('#','%23');

              return new L.Icon({
                  iconUrl: url
              });

						});

		//  var types = xf.dimension(function(d) { return d.variety; });
		//
		var panchayath = xf.dimension(function(d){ return d.pt});
		//  var typesGroup = types.group();
		//
		 var pie = dc.pieChart(".pie",groupname)
				 .dimension(panchayath)
				 .group(panchayath.group())
				.slicesCap(26)
				// .innerRadius(150)
				// .legend(dc.legend().autoItemWidth(true).gap(7).x(500))
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
