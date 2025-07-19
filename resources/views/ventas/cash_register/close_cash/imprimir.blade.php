@extends('layouts.admin')

@section('contenido')

<!-- <h1> Resumen de cierre Caja </h1> -->
<div class="text-center">
	<a href="{{URL::action('CashController@close')}}"><button class="btn btn-success">Volver</button></a>
	<a href=""><button onclick="imprimir();" class="btn btn-success">Imprmir</button></a>
</div>
<div class="row">
	<div class="col-sm-6 col-md-6 contenedor" id="imprimir">
        <div class="panel panel-info">
            <div>
                <h4 class="text-center">
                    CIERRE DE CAJA
                </h4>
   				<h4 class="text-center">{{$data->nom_caja}} </h4>
                

                <table class="table table-striped table-bordered table-condensed table-hover" id="table">
                    <thead>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td>Saldo Inicial</td>
                            <td class="text-right"> {{$data->saldo_inicial}} </td>
                        </tr>
						<tr>
                        	<td>Ingreso a Caja</td>
                            <td class="text-right"> {{$data->ingreso_caja}} </td>
                        </tr>
                        <tr>
                        	<td>Tipo de Ventas Realizadas</td>
                            <td> </td>
                        </tr>
                    	@foreach($data_lines as $metodo_pago)
                        <tr>
                        	<td class="text-center">{{$metodo_pago->name_method}}</td>
                            <td class="text-right"> {{ $metodo_pago->amount}} </td>
                        </tr>
                    	@endforeach
                    	<tr>
                        	<td>Total Ventas</td>
                            <td class="text-right"> {{$suma_data_lines}}</td>
                        </tr>
                        <tr>
                        	<td></td>
                            <td class="text-right"> </td>
                        </tr>
                        <tr>
                        	<td>Salida de caja</td>
                            <td class="text-right"> (-) {{$data->salida_caja}} </td>
                        </tr>
						 
                        <tr>
                        	<td>Saldo Faltante</td>
                            <td class="text-right"> {{$data->saldo_faltante}}</td>
                        </tr>
                        <tr>
                        	<td>Saldo Sobrante</td>
                            <td class="text-right"> {{$data->saldo_sobrante}}</td>
                        </tr>
                        <tr>
                        	<td>Total Entregado</td>
                            <td class="text-right"> {{$data->saldo_final}}</td>
                        </tr>
                    </tbody>
                </table>

            	<div class="row">
	                <div class="col-sm-12 col-md-12">
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