@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="box">
        <details>  
            <summary onclick="togleAccordeon()">
                <div class="box-header with-border">
                    <h5 class="h5 text-primary text-bold">
                        Filtros de Búsqueda <span style="cursor:pointer" id="labelAccordeon"> [+ Ver más] </span>
                    </h5>
                </div>
            </summary>  
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sucursal</label>
                            <select class="form-control" onChange="selectSucursal(event)">
                                <option selected value="">-- Seleccionar Sucursal --</option>
                                @foreach($filtros['listSucursal'] as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Núm Caja</label>
                            <select class="form-control" onChange="selectNumCaja(event)">
                                <option selected value="">-- Seleccionar Núm Caja --</option>
                                @foreach($filtros['listNumCaja'] as $numeroCaja)
                                    <option value="{{ $numeroCaja->id }}">{{ $numeroCaja->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Personal</label>
                            <select class="form-control selectpicker"  data-live-search="true" onChange="selectPersonal(event)">
                                <option value="">-- Seleccionar Personal --</option>
                                @foreach($filtros['listPersonal'] as $persona)
                                    <option value="{{ $persona->PERSON_ID }}">{{ $persona->FULL_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo de Operación</label>
                            <select class="form-control" onChange="selectTipoOperacion(event)">
                                <option selected value="">-- Seleccionar Tipo de Operación --</option>
                                @foreach($filtros['listTipoOperacion'] as $tipoOperacion)
                                    <option value="{{ $tipoOperacion->name }}">{{ $tipoOperacion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <div class="row" style="display: flex; align-items:center">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" id="fechaInicio" class="form-control" onChange="onChangeFechaInicio(event)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date" id="fechaFin" class="form-control" onChange="onChangeFechaFin(event)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{-- <button class="btn btn-primary btn-block" onclick="getDataWithfilter()">
                            Filtrar
                        </button> --}}
                    </div>
                </div>
            </div>
        </details> 
    </div>

    <div class="box">
         
        <div class="box-header with-border">
            <h3 class="box-title">
                MOVIMIENTOS REALIZADOS DE CAJA
            </h3>
            <div class="box-tools">
                <div class="text-center">
                     
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
								<tr>
									{{-- <th hidden>ID</th> --}}
									<th>SUCURSAL</th>
									<th>NUM CAJA</th>
									<th>PERSONAL</th>
									<th>FEC-TRANSACCION</th>
									<th>ESTADO</th>
									<th>TIPO</th>
									<th>MONTO</th>
									{{-- <th hidden>COMENTARIO</th> --}}
								</tr>
                            </thead>
                            <tbody>
                            @foreach($data as $vehiculo)
                                <tr>
                                    {{-- <td hidden> {{ $vehiculo->cash_reg_id }}   </td> --}}
                                    <td> {{ $vehiculo->sucursal->name }}   </td>
									<td> {{ $vehiculo->caja->name }}   </td>
									<td> {{ $vehiculo->personal->FULL_NAME }}   </td>
                                    <td> {{ $vehiculo->created_at}}   </td> 
									<td> {{ $vehiculo->status}}   </td> 
									<td> {{ $vehiculo->type_operation}}   </td> 
									<td> {{ $vehiculo->amount}}   </td> 
									{{-- <td hidden> {{ $vehiculo->comment}}   </td>  --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        let labelAccordeon = document.getElementById('labelAccordeon');

        labelAccordeon.innerText = "[+ Ver más]";

        let currentFecha = new Date().toISOString().substring(0, 10)

        $('#fechaInicio').attr({
            "max" : currentFecha
        });

        $('#fechaFin').attr({
            "max" : currentFecha
        });
        

        let filter = {
            sucursalId: null,
            numeroCajaId : null,
            personalId : null,
            tipoOperacionId: null,
            fechaInicio: null,
            fechaFin: null
        }

        $(document).ready(function () {
            $('#table').DataTable({
				 dom: 'Bfrtip',
                buttons: [
                    //'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Reporte de Movimientos Realizados',
                    },
					{
						extend:    'pdfHtml5',
						 title: 'Reporte de Movimientos Realizados',
						orientation: 'landscape',
		                footer: true
					},
					{
						extend:    'print',
						 title: 'Reporte de Movimientos Realizados',
						orientation: 'landscape',
		                footer: true
					}
                                            
                ],
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });

            /* setTimeout(() => {
                $(".select2").select2();     
            }, 1000);
             */
        }); 

        togleAccordeon = () => {
            if(labelAccordeon.innerText == '[+ Ver más]'){
                labelAccordeon.innerText = '[- Ver menos]';
            }else{
                labelAccordeon.innerText = '[+ Ver más]';
            }
        }

        selectSucursal = (event) =>  {
            filter.sucursalId = Number(event.target.value)
            if (event.target.value == "") filter.sucursalId = null;
            this.onchangeFiltro();
        }
        
        selectNumCaja = (event) =>  {
            filter.numeroCajaId = Number(event.target.value)
            if (event.target.value == "") filter.numeroCajaId = null;
            this.onchangeFiltro();
        }

        selectPersonal = (event) =>  {
            filter.personalId = Number(event.target.value)
            if (event.target.value == "") filter.personalId = null;
            this.onchangeFiltro();
        }

        selectTipoOperacion = (event) =>  { 
            filter.tipoOperacionId = event.target.value
            if (event.target.value == "") filter.tipoOperacionId = null;
            this.onchangeFiltro();
        }

        onChangeFechaInicio = (event) =>  {
            filter.fechaInicio = event.target.value
            this.onchangeFiltro();
        }

        onChangeFechaFin = (event) =>  {
            filter.fechaFin = event.target.value
            this.onchangeFiltro();
        }

        getDataWithfilter = () => {
            this.getData();
        }

        onchangeFiltro = () => {
            this.getData()
        }

        getData = () => {
            const url  = `/cash/history/with_filter`;
            $.ajax(url, {
                data : JSON.stringify(filter),
                contentType : 'application/json',
                type : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 success: function(data) {
                    
                    const tableData = data.map( item => {
                        return [
                            item.sucursal.name,
                            item.caja.name,
                            item.personal.FULL_NAME,
                            item.created_at,
                            item.status,
                            item.type_operation,
                            item.amount
                        ];
                    });

                    $('#table').DataTable().clear().draw();

                    $('#table').DataTable().rows.add(tableData).draw();
                 }
            });
        }

    </script>
@endsection