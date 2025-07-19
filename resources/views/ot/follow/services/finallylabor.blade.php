@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')
    <div class="box">
       
        <div class="box-header with-border">
            <h3 class="box-title">
                Listado de Labores Asignadas a personal - Pendientes de terminar para completar
            </h3>
			 
			<br>
			FEC ASIGNADA = FECHA HORA QUE SE ASIGNO AL TECNICO
			<br>
			FEC TERMINO = FEC CREACION + minutos de labor
			  
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
 									<th>OT</th>
									<th>PLACA</th>
 									<th>LABOR</th>
 									<th>TECNICO</th> 
 									<th>FEC ASIGNADO</th>
									<th>FEC FIN PRG.</th>
									<th>T (MIN). FALTANTE</th>
									<th>ACCIONES</th> 
								</tr>
                            </thead>
                            <tbody>
							@foreach($labores as $data)
						 
								<tr> 
									<td>   {{ $data->numot }}</td>
									<td>   {{ $data->placa }}  </td>
									<td>   {{ $data->nomlabor }} </td>
									<td>   {{ $data->tecnico }} </td> 
									<td>   {{ $data->laborasignada  }} </td>
									<td>   {{  $data->finestimado  }} </td>
									<td align="right">  @if ( $data->fecsistema > $data->finestimado )
											Exc  {{ round ( $data->tfaltante/60 * -1,2) }}  Hrs
										@else
											{{  $data->tfaltante  }}
										@endif
	
									 </td>
									<td> 
										<input type="hidden" value="{{ $data->idAsign }}" class="idRecord">
                                        
										<a class="anular" href="#" >  Finalizar  </a>
                                    </td> 
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
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
		
		$(".empezar").click( function() {
                var valor ="";

                $(this).parents("tr").find("td").each(function(){
                    //valores+=$(this).html()+"\n";
                    valor = $(this).find(".idRecord").val();
                 });
				
				

                   Swal.fire({
						  title: 'Desea INICIAR el servicio?',
						  showDenyButton: true,
						  showCancelButton: true,
						  confirmButtonText: `Aceptar`
                        })
                        .then((result) => {

							if (result.isConfirmed) 
							{

								$.ajax({
									type:'GET',
									url:'/complete/service/'+valor,

								}).done(function(res)
										{
											Swal.fire({
											   
											  icon: 'success',
											  title: 'Servicio completado',
											  showConfirmButton: false,
											  timer: 1200
											})
											.then( (val) => {
														window.location="{{ url('/list/finallylabor') }}";
													});
											
										});

							} else {

									swal("Cancelado el proceso de eliminacion!")
									.then((value) => {
										window.location="{{ url('/ot/receipt') }}";
									});

							}

                        });

        });
		
		$(".anular").click( function() {
                var valor ="";

                $(this).parents("tr").find("td").each(function(){
                    //valores+=$(this).html()+"\n";
                    valor = $(this).find(".idRecord").val();
                 });
				
				

                   Swal.fire({
						  title: 'Desea finalizar el servicio?',
						  showDenyButton: true,
						  showCancelButton: true,
						  confirmButtonText: `Aceptar`
                        })
                        .then((result) => {

							if (result.isConfirmed) 
							{

								$.ajax({
									type:'GET',
									url:'/complete/service/'+valor,

								}).done(function(res)
										{
											Swal.fire({
											   
											  icon: 'success',
											  title: 'Servicio completado',
											  showConfirmButton: false,
											  timer: 1200
											})
											.then( (val) => {
														window.location="{{ url('/list/finallylabor') }}";
													});
											
										});

							} else {

									swal("Cancelado el proceso de eliminacion!")
									.then((value) => {
										window.location="{{ url('/ot/receipt') }}";
									});

							}

                        });

        });

    </script>
@endsection