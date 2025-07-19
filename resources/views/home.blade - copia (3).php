  @extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Estadísticas</h3>
	</div>
</div>

<?php 
foreach ($totales as $total)
{
?>


<div class="row">
 
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<p>CLLIENTES</p><h4 style="font-size:17px;"><strong>32</strong></h4>
				</div>
				<a href="{{url('ventas/cliente')}}" class="small-box-footer">CLLIENTES <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<p>PRODUCTOS</p> <h4 style="font-size:17px;"><strong><?php echo $total->totalitems;?></strong></h4>
				</div>
				<a href="{{url('almacen/item')}}" class="small-box-footer">PRODUCTOS <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<p>USUARIOS</p> <h4 style="font-size:17px;"><strong>7</strong></h4>
				</div>
				<a href="{{url('seguridad/usuario')}}" class="small-box-footer">USUARIOS <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
    

		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<p>CATEGORIAS</p> <h4 style="font-size:17px;"><strong>8</strong></h4>
				</div>
				<a href="{{url('almacen/categoria')}}" class="small-box-footer">CATEGORIAS <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

          

</div>


<div class="row">
 
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<p>COMPRAS</p> 
				</div>
				<a href="{{url('compras/orden')}}" class="small-box-footer">COMPRAS <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<p>HACER VENTA</p> 
				</div>
				<a href="{{url('quotes/create')}}" class="small-box-footer">HACER VENTA <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		
		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<p>KARDEX</p>  
				</div>
				<a href=" " class="small-box-footer">KARDEX <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
    

		<div class="col-lg-2 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<p>REPORTES</p>  
				</div>
				<a href="{{url('quotesStd/reports')}}" class="small-box-footer">REPORTES <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>

          

</div>
<?php }?>


        <!-- Estadísticas gráficos -->
        


@push ('scripts')
<script src="{{asset('js/Chart.js')}}"></script>

    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

  /*
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });
*/
        var ComprasMes = {
          labels: [<?php foreach ($comprasmes as $reg)
          			{echo '"'. $reg->mes.'",';} ?>],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: []
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php foreach ($comprasmes as $reg)
          			{echo ''. $reg->totalmes.',';} ?>]
            }
          ]
        };

        var VentasMes = {
          labels: [<?php foreach ($ventasmes as $reg)
          			{echo '"'. $reg->mes.'",';} ?>],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: []
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php foreach ($ventasmes as $reg)
          			{echo ''. $reg->totalmes.',';} ?>]
            }
          ]
        };

        var VentasDias = {
          labels: [<?php foreach ($ventasdia as $reg)
          			{echo '"'. $reg->dia.'",';} ?>],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: []
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php foreach ($ventasdia as $reg)
          			{echo ''. $reg->totaldia.',';} ?>]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
         

        //-------------
        //- LINE CHART -
        //--------------
         

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
         
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
         
      $('#liEstadistica').addClass("treeview active");
      $('#liEscritorio').addClass("active");

    </script>
@endpush
@endsection