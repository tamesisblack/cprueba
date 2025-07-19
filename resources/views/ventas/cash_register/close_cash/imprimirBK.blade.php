@extends('layouts.admin')

@section('contenido')

<!-- <h1> Resumen de cierre Caja </h1> -->
<div class="row">
	<div class="col-sm-6 col-md-6 contenedor" id="imprimir">
        <div class="panel panel-info">
            <div>
                <h4 class="text-center">
                    CIERRE DE CAJA
                </h4>
   				<h4 class="text-center"> {{$data->nom_caja}} </h4>
                
            	<div class="row">
            		<div class="col-sm-12 col-md-12">
	            		<div class="form-group row">
	                      <label for="inputtext1" class="col-sm-4 col-md-4 col-lg-6 control-label text-center">SALDO INICIAL </label>
	                      <div class="col-sm-8 col-lg-6">
	                        <input type="text" class="form-control text-right" name="saldo_inicial" id="saldo_inicial" placeholder="" value="{{$data->saldo_inicial}}" readonly>
	                      </div>
	                    </div>
	                </div>
            	</div>
            	<div class="row">
	                <div class="col-sm-12 col-md-12">
	                    <div class="form-group row">
	                      <label for="inputtext2" class="col-sm-12  col-md-12 col-lg-12 control-label">Tipo de Ventas Realizadas </label>		                      
	                    </div>
	                    @foreach($data_lines as $metodo_pago)
                            <div class="form-group row">
		                      <label for="inputtext1" class="col-sm-4 col-md-4 col-lg-6 control-label text-center">{{$metodo_pago->name_method}}</label>
		                      <div class="col-sm-8 col-lg-6">
		                        <input type="text" class="form-control text-right" id="inputtext1" value="{{ $metodo_pago->amount}}" placeholder="" disabled>
		                      </div>
		                    </div>
                        @endforeach
                        <div class="form-group row">
	                      <label for="total_ventas" class="col-sm-4  col-md-4 col-lg-6 control-label">Total Ventas</label>
	                      <div class="col-sm-8 col-lg-6">
	                        <input type="text" class="form-control text-right" id="total_ventas" placeholder="" value="{{$suma_data_lines}}" disabled>
	                      </div>
	                    </div>
	                    <br>
                        <div class="form-group row">
	                      <label for="inputtext1" class="col-sm-4 col-md-4 col-lg-6 control-label">RETIRO de caja</label>
	                      <div class="col-sm-8 col-lg-6">
	                        <input type="text" class="form-control text-right" id="inputtext1" placeholder="" value="{{$data->salidas}}" disabled>
	                      </div>
	                    </div>

			            <div class="form-group row">
			              <label for="saldo_faltante" class="col-sm-4  col-md-4 col-lg-6 control-label">Saldo Faltante</label>
			              <div class="col-sm-4 col-md-4 col-lg-6">
			                <input type="text" class="form-control text-right" name="saldo_faltante" id="saldo_faltante" value="{{$data->saldo_faltante}}" placeholder="" readonly>
			              </div>
			            </div>

			            <div class="form-group row">
			              <label for="saldo_sobrante" class="col-sm-4 col-lg-6 control-label">Saldo Sobrante</label>
			              <div class="col-sm-4 col-md-4  col-lg-6">
			                <input type="text" class="form-control text-right" name="saldo_sobrante" id="saldo_sobrante" value="{{$data->saldo_sobrante}}" placeholder="" readonly>
			              </div>
			            </div>
			            <div class="form-group row">
			              <label for="saldo_final" class="col-sm-4 col-md-4 col-lg-6 control-label">SALDO FINAL CAJA</label>
			              <div class="col-sm-4 col-md-4 col-lg-6">
			                <input type="text" class="form-control text-right" name="saldo_final" placeholder="" value="{{$data->saldo_final}}" readonly>
			              </div>
			            </div>
			            <br>
			        	<div class="col-sm-12 col-md-12">
			        		<div class="text-center row">
			        			<label>------------------------------   &nbsp;&nbsp;&nbsp;&nbsp;   -------------------------</label>
			        		</div>
			        		<div class="text-center row">
				        		<label>ENTREGUE CONFORME &nbsp;&nbsp;&nbsp; RECIBI CONFORME</label>
				        	</div>
			        		<div class="text-center row">
				        		<label> Usuario : {{auth()->user()->name}} {{$hoy->format('Y-m-d H:i:s')}} 
				        	</label>
			        	</label>
			        </div>
		        </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
	<a href="{{URL::action('CashController@close')}}"><button class="btn btn-success">Volver</button></a>
	<a href=""><button onclick="imprimir();" class="btn btn-success">Imprmir</button></a>
</div>
	@push('scripts')

	<script>
		$(document).ready(function() {});

		function imprimir() {
			var printContent = document.getElementById('imprimir');
            var WinPrint = window.open('', '', 'width=1500,height=1000');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.print();
            WinPrint.document.close();
		}
	</script>
	@endpush
@endsection