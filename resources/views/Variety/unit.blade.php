<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Variety</title>

	<meta itemprop="name" content="DC.js + Leaflet"/>
	<meta itemprop="description" content="DC.js + Leaflet chart"/>

	<meta charset="UTF-8">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link type="text/css" href="{{asset('css/dc.css')}}" rel="stylesheet"/>
  <!-- <link type="text/css" href="{{asset('css/leaflet-legend.css')}}" rel="stylesheet"/> -->
  <link type="text/css" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css"   href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"/>



  <style>

	body{
		/* background-image: url( "{{asset('images/background.jpg')}}"); */
		background-color: white;
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

		<div class="col pie p-5">
      <table class='table table-striped table-bordered bg-secondary' id='dc-table-chart' >
        <thead>
          <tr>
            <th>Index</th>
            <th>Bhoomi</th>
            <th> Number </th>
            <th> Land</th>
            <th> Loss</th>
            <th> Overcome</th>
            <th> Panchayath</th>

          </tr>
        </thead>
        <tbody>

        @foreach ($data as $unit)

            <tr>
              <td>

              </td>
              <td>
                {{ucfirst($unit->bhoomi)}}
              </td>
              <td>
                {{$unit->ennam}}
              </td>
              <td>
                {{$unit->land}}
              </td>
              <td>
                {{$unit->loss}}
              </td>
              <td>
                {{$unit->overcome}}
              </td>
              <td>
                {{($unit->datapoint)->panchayath->name}}
              </td>
            </tr>

        @endforeach
      </tbody>
      </table>

		</div>

	</div>

</div>






<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script type="text/javascript" src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js "></script>
<script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>







<script type="text/javascript">

  /*     Markers      */




 var data = {!! json_encode($data->toArray()) !!}

 // function drawMarkerArea(data) {
 //
	// 	console.log(data);
	// 	 var xf = crossfilter(data);
	// 	 var groupname = "marker-area";
	// 	 var facilities = xf.dimension(function(d) { return d.geo.latitude+","+d.geo.longitude });
 //
	// 	 // var facilitiesGroup = facilities.group();
 //
	// 	 var max = facilities.group().reduceSum(function (d){
	// 		 return d.ennam;
	// 	 }).top(1)[0].value;
 //
	// 	 var output_range = 100;
	// 	 var icon_min_size=2;
 //
	// 	 if(max < 10){
	// 		 output_range = max*2;
	// 	 }
	// 	 else if(max < 50){
	// 		 output_range = 20;
	// 	 }else if(max < 100){
	// 		 output_range = 40;
	// 	 }else{
	// 		 output_range = 50;
	// 	 }
 //
	// 	 var x = d3.scaleLinear()
 //    .domain([0, max])
 //    .rangeRound([0, output_range]);
 //
 //
 //
 //
	// 	var color = d3.scaleLinear()
	//  .domain([0, output_range])
	//  .range(["red", "white"]);
 //
 //
 //
	// 	var testGroup = facilities.group().reduceSum(function(d){
	// 		return d.ennam;
	// 	});
 //
	// 	var dump = xf.dimension(function(d){
	// 		return [d.geo.latitude,d.geo.longitude];
	// 	});
 //
	// 	var test=dump.group().reduceSum(function(d){
	// 		return d.ennam;
	// 	});
 //
	// 	var pointsHeat = test.all().map(function(d){
	// 		return [d.key[0],d.key[1],d.value];
	// 	});
 //
 //
	// 	 var increment = Math.floor(output_range/10);
 //
	// 	 var marker = dc_leaflet.markerChart(".map",groupname)
	// 			 .dimension(facilities)
	// 			 .group(testGroup)
	// 			 .valueAccessor(d=>d.value)
	// 			 .center([11.79056,75.99561])
	// 			 .zoom(10)
	// 			 .renderPopup(true)
 //        	.filterByArea(true)
	// 				.icon(function(d) {
 //              var iconUrl;
	// 						var testValue= Math.ceil(x(d.value)/increment)+icon_min_size;
	// 						// console.log(testValue);
	// 						// console.log(color(testValue-icon_min_size));
 //
	// 						var svg = ' <svg xmlns="http://www.w3.org/2000/svg"><circle cx="'+testValue*2+'" cy="'+testValue*2+'" r="'+testValue*2+'"  stroke="red" fill="'+color(testValue-icon_min_size)+'" fill-opacity="0.9" /></svg> ' ;
 //
	// 						var url = encodeURI("data:image/svg+xml," + svg).replace('#','%23');
 //
 //              return new L.Icon({
 //                  iconUrl: url
 //              });
 //
	// 					});
 //
	// 					// L.heatLayer(pointsHeat, {radius:5, blur: 5 , maxZoom:15 ,gradient: {0.4: 'yellow', 0.65: 'lime', 1: 'green'}}).addTo($('.map'));
 //
 //
	// 	//  var types = xf.dimension(function(d) { return d.variety; });
	// 	//
	// 	var panchayath = xf.dimension(function(d){ return d.pt});
	// 	//  var typesGroup = types.group();
	// 	//
	// 	 var pie = dc.pieChart(".pie",groupname)
	// 			 .dimension(panchayath)
	// 			 .group(panchayath.group())
	// 			.slicesCap(26)
	// 			// .innerRadius(150)
	// 			// .legend(dc.legend().autoItemWidth(true).gap(7).x(500))
	// 			.on('pretransition',function(chart){
	// 				chart.selectAll('text.pie-slice').text(function(d) {
	// 						return d.data.key + ' ' + dc.utils.printSingleValue((d.endAngle - d.startAngle) / (2*Math.PI) * 100) + '%';
	// 				})
	// 			})
	// 			 .renderLabel(true)
	// 			 .renderTitle(true)
	// 			 .ordering(function (p) {
	// 					 return -p.value;
	// 			 });
	// 	//
	// 	// 	var height = 0;
	// 	// 	var hAll = panchayath.group().all().length;
	// 	//
	// 	// var row = dc.rowChart(".rowChart",groupname)
	// 	// 			.width(300)
	// 	// 			.height(hAll*20)
	// 	// 			.dimension(panchayath)
	// 	// 			.group(panchayath.group())
	// 	// 			.ordering(function (p) {
	// 	// 				return -p.value;
	// 	// 			})
	// 	// 	 .elasticX(true);
 //
	// 	 dc.renderAll(groupname);
	// 	 return {marker: marker};
 // }


 // drawMarkerArea(data);

 console.log(data);

 var datatable =$('#dc-table-chart').DataTable({

   "columnDefs": [ {
     "searchable": false,
     "orderable": false,
     "targets": 0,

 } ],
 "order": [[ 6, 'asc' ]],
 "lengthMenu": [[5,10, 15,20, -1], [5, 10, 15,20, "All"]],
 "dom": 'lBfrtip',
  "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
 });

 datatable.on( 'order.dt search.dt', function () {
datatable.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    cell.innerHTML = i+1;
} );
} ).draw();







</script>

</body>
</html>
