<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Panchayaths</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link type="text/css" href="{{asset('css/dc.css')}}" rel="stylesheet"/>
        <!-- <link type="text/css" href="{{asset('css/leaflet-legend.css')}}" rel="stylesheet"/> -->
        <link type="text/css" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
        <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

        <!-- Styles -->
        <style>
        body{
          /* background-image: url( "{{asset('images/background.jpg')}}"); */
          background-color: white;
          background-size: cover;
          backface-visibility: hidden;
        }

        </style>
    </head>
    <body>


      <div class="container">

        <div class="page-header text-primary pb-2 mt-4 mb-2">
          <h1>All Panchayath</h1>
          <hr/>
        </div>

        <table class='table table-striped table-bordered bg-secondary' id='dc-table-chart' >
        <thead>
          <tr>
            <th>Index</th>
            <th> Panchayath </th>
            <th>Data Points</th>
            <th>Crop Units</th>
          </tr>
        </thead>
        <tbody>

      </tbody>

        </table>

      </div>

      <script type="text/javascript" src="{{asset('js/d3.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/crossfilter.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/dc.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
      <script type="text/javascript" src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
      <script type="text/javascript" src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>


      <script>

      var data = {!! json_encode($data->toArray()) !!}

      var xf = crossfilter(data);

      var dim = xf.dimension(function(d){
        return d.datapoints;
      });




              var datatable =$('#dc-table-chart');
              var datatableOptions={

                "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0,
                  data: function(d) {
                      return d.name;
                  },
                  defaultContent: ''
              },{
                targets: 1,
                data: function(d) {
                    return d.name[0].toUpperCase() + d.name.slice(1);
                },
                defaultContent: ''
              } ,
              {
                targets: 2,
                data: function(d) {
                    return d.datapoints.length;
                },
                defaultContent: ''
              } ,
              {
                targets: 3,
                data: function(d) {
                    return d.testCount;
                },
                defaultContent: ''
              }
            ],
              "order": [[ 1, 'asc' ]],
              "lengthMenu": [[5,10, 15,20, -1], [5, 10, 15,20, "All"]]
              };



         var tableDimension = xf.dimension(function(d) {
             // return d.name.toLowerCase() + ' ' +
             //     d.name.toLowerCase() + ' ' +
             //     d.name.toLowerCase() + ' ' +
             //     d.name;

             var testCount = d.datapoints.reduce(function(sum,d){

               var count;
               if(d.data_point_ids === undefined){
                  count=0;
                }
                else{
                  count = d.data_point_ids.length;
                }

                sum = sum + count;

                return sum;
              }  ,0);

              d['testCount']=testCount;


             return [d.name,d.name,d.datapoints.length,d.testCount];


         });

         function RefreshTable() {

             dc.events.trigger(function() {
                 alldata = tableDimension.top(Infinity);
                 datatable.fnClearTable();
                 datatable.fnAddData(alldata);
                 datatable.fnDraw();
             });
           }

          datatable.dataTable(datatableOptions);
           RefreshTable();

           datatable.on( 'order.dt search.dt', function () {
             datatable.api().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
               cell.innerHTML = i+1;
             } );
           } ).api().draw();

           dc.renderAll();


         </script>



    </body>
</html>
