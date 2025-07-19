@extends('layouts.admin')



@section('title', 'Listado de vehiculos')



@section('contenido')

    <div class="box">


        <div class="box-header with-border">

            <h3 class="box-title">

              Listado de recibos

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

                                <th>NRO OT</th>
								<th>CLIENTE</th>
                                <th>PLACA</th>
								<th>NUM RECIBO</th>
                                <th>FEC. RECIBO</th>
                                <th>TIPO RECIBO</th>
                                <th>IMPORTE</th>
                                <th>ESTADO</th>
    
                                <th>ACCIONES</th>
                            </tr>

                            </thead>

                            <tbody>


                            @foreach($rsot as $rset)

                                <tr>

                                    <td> @if($rset->ordentrabajo)  {{ $rset->ordentrabajo->wip_entity_name }} 
										@else 'NA' @endif</td>

									<td>  @if($rset->cliente)  {{ $rset->cliente->full_name }}  
										@else 'NA' @endif </td>
									<td>  @if($rset->vehiculo)  {{ $rset->vehiculo->placa }}  
										@else 'NA' @endif </td>	
                                
									<td>  {{ $rset->receipt_num }} </td>

                                    <td>  {{ $rset->receipt_date }}  </td>
                                     
                                    <td> @if ($rset->type == "PREPAYMENT") Anticipo
                                        @elseif ($rset->type == "PAYING") Liquidacion
                                        @elseif ($rset->type == "CREDIT")   Por Credito
                                        @endif

                                    </td>

                                    <td align="right">  {{ number_format ($rset->amount ,2) }}  </td>
									 
                                     <td>  {{  $rset->status_type }} </td> 
                                    <td>

                                         <input type="hidden" value="{{ $rset->id }}" class="idot">

                                        <a class="anular" href="#" >
                                            <i  style="color:red;" class="fa fa-ban" aria-hidden="true"></i>
                                        </a>

                                         <a  class="print" target="_blank" href="{{ url('/print/adelanto', $rset->id) }}">

                                            <i class="fa fa-print" aria-hidden="true"></i>

                                        </a>
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
@push ('scripts')
<script>
$('#liOT').addClass("treeview active");
$('#liRecibos').addClass("active");
</script>
@endpush



@section('js')

    <script type="text/javascript">

        $(document).ready(function () {

            $('#table').DataTable({

                "language": {

                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"

                }

            });

            $(".anular").click( function() {
                var valor ="";

                $(this).parents("tr").find("td").each(function(){
                    //valores+=$(this).html()+"\n";
                    valor = $(this).find(".idot").val();
                 });
				
				

                   Swal.fire({
						  title: 'Desea anular el recibo?',
						  showDenyButton: true,
						  showCancelButton: true,
						  confirmButtonText: `Save`
                        })
                        .then((result) => {

							if (result.isConfirmed) 
							{

								$.ajax({
									type:'GET',
									url:'/Edit/Receipt/'+valor,

								}).done(function(res)
										{
											Swal.fire({
											   
											  icon: 'success',
											  title: 'Recibo cancelado',
											  showConfirmButton: false,
											  timer: 1200
											})
											.then( (val) => {
														window.location="{{ url('/ot/receipt') }}";
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


            $('.print').click(function (){




            });



        });

    </script>

@endsection
