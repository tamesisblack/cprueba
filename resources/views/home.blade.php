@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Estadísticas</h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Top 10 - Mas Comprados</h3>
                        </div>

                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Producto</th>
                                    <th>Total S/.</th>
                                    <th style="width: 40px">Cant Oc Aprobadas</th>
                                </tr>
                                @foreach($bestSellers as $index => $best)
                                    <tr>
                                        <td>{{$index + 1 }}</td>
                                        <td>{{$best->vendor_name}}</td>
                                        <td align="right" >{{number_format($best->TOTAL, 2)}}</td>
                                        <td align="right">{{ number_format($best->CONTAR, 2)}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-body">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-warning">
						<div class="box-header">
                            <h3 class="box-title">Relacion de Compras S/. por Mes</h3>
                        </div>

                        <div class="box-body no-padding">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>

                                    <th>MES</th>
                                    <th>TOTAL S/.</th>
                                </tr>
                                @foreach($rows as $index => $chart)
                                    <tr>
                                        <td>{{$chart->MES }}</td>
                                        <td>{{$chart->TOTAL}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-default">
                        <div class="box-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>



    <!-- Estadísticas gráficos -->



    @push ('scripts')
        <script src="{{asset('js/Chart.js')}}"></script>

        <script>
          $(function () {

            BARCHART("barChart")
            LINECHART("lineChart")

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

            //-------------
            //- BAR CHART -
            //-------------

            $('#liEstadistica').addClass("treeview active");
            $('#liEscritorio').addClass("active");

          })

          const data = {!! json_encode($charts) !!};
          let dataSetsTopTxt = {
            duration: 1,
            onComplete: function () {
              var chartInstance = this.chart,
                ctx = chartInstance.ctx;
              ctx.textAlign = 'center';
              ctx.fillStyle = "rgba(0, 0, 0, 1)";
              ctx.textBaseline = 'bottom';
              // Loop through each data in the datasets
              this.data.datasets.forEach(function (dataset, i) {
                var meta = chartInstance.controller.getDatasetMeta(i);
                meta.data.forEach(function (bar, index) {
                  var data = dataset.data[index];
                  ctx.fillText(data, bar._model.x, bar._model.y - 5);
                });
              });
            }
          }
          const BARCHART = (idCanvas) => {
            let ctx = document.getElementById(idCanvas).getContext("2d");
            let myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: data.label, datasets: [{
                  label: '# Total',
                  data: data.data,
                  backgroundColor: '#4682B4',
                  showLine: true,
                  borderWidth: 1,
                  tension: 0.2
                }]
              },
              options: {
                tooltips: {
                  enabled: true
                },
                locale: 'es-ES',
                showLines: false,
                scales: {
                  xAxes: [{
                    stacked: true
                  }],
                  yAxes: [{
                    stacked: true
                  }]
                },
                hover: {
                  animationDuration: 1
                },
                animation: dataSetsTopTxt
              }
            });
          }

          const LINECHART = (idCanvas) => {
            let ctx = document.getElementById(idCanvas).getContext("2d");
            let myChart = new Chart(ctx, {
              type: 'line', data: {
                labels: data.label, datasets: [{
                  label: '# Total',
                  showLine:true,
                  fill: false,
                  tension: 0.1,
                  borderColor: "#4682B4",
                  data: data.data
                }]
              }, options: {
                hover: {
                  animationDuration: 1
                },
                animation: dataSetsTopTxt,
                locale: 'es-ES',
                showLines: false,
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                }
              }
            });
          }

        </script>
    @endpush
@endsection