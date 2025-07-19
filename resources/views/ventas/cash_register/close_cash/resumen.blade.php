@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')

<!-- <h1> Resumen de cierre Caja </h1> -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <form name="form-close" action="{{ route('cash.update',$data->caja_id) }}" method="POST">
            {{ csrf_field() }}
            <div class="panel-heading">
                <h3 class="panel-title">
                    Cerrar Caja {{$data->nom_caja}}
                </h3>
            </div>
            
            <div class="panel-body">
        
                
            	<div class="row">
            		<div class="col-sm-4 col-md-4">
	            		<div class="form-group row">
	                      <label for="inputtext1" class="col-sm-4 col-md-4 col-lg-6 control-label text-center">SALDO INICIAL </label>
	                      <div class="col-sm-8 col-lg-6">
	                        <input type="text" class="form-control text-right" name="saldo_inicial" 
								id="saldo_inicial" placeholder="" value="{{$data->saldo_inicial}}" readonly>
	                      </div>
	                    </div>
	                </div>
            	</div>
            	<div class="row">
	                <div class="col-sm-4 col-md-4">
	                	<div class="panel panel-success">
	                    	<div class="panel-heading">
			                    <h3 class="panel-title">
			                        Ingresos
			                    </h3>
			                </div>
			                <div class="panel-body">
			                	<div class="form-group row">
			                      <label for="inputtext1" class="col-sm-8 col-md-8 col-lg-6 control-label">Ingresos a caja</label>
			                      <div class="col-sm-4 col-md-4 col-lg-6">
			                        <input type="text" class="form-control text-right" name="ingreso_caja"  
										id="ingreso_caja" placeholder=""  value="{{$data->ingresos}}" readonly>
			                      </div>
			                    </div>
			                    <div class="form-group row">
			                      <label for="inputtext2" class="col-sm-12  col-md-12 col-lg-12 control-label">Tipo de Ventas Realizadas :</label>		                      
			                    </div>
			                    <div style="display:none"> {{$i=0}} </div>
			                    @foreach($metodos_pago as $metodo_pago)
                                    <div class="form-group row">
				                      <label for="inputtext1" class="col-sm-4 col-md-4 col-lg-6 control-label text-center">{{$metodo_pago->name}}</label>
				                      <div class="col-sm-8 col-lg-6">
				                        <input type="text" class="form-control text-right" id="inputtext1" value="{{ $data->metodopago[$i]}}" placeholder="" disabled>
				                      </div>
				                    </div>
				                    <div style="display:none"> {{$i++}} </div>
                                @endforeach
			                </div>
			            </div>

	                </div>
	                <div class="col-sm-4 col-md-4">
	                	<div class="panel panel-danger">
	                    	<div class="panel-heading">
			                    <h3 class="panel-title">
			                        Salidas
			                    </h3>
			                </div>
			                <div class="panel-body">
			                	<div class="form-group">
			                      <label for="inputtext1" class="col-sm-4  col-md-4 col-lg-6 control-label">RETIRO de caja</label>
			                      <div class="col-sm-8 col-lg-6">
			                        <input type="text" class="form-control text-right" name="salida_caja"  
										id="salida_caja"  placeholder="" value="{{$data->salidas}}" readonly>
			                      </div>
			                    </div>
			                </div>
			            </div>
	                </div>
            	</div>
                <div class="col-sm-4 col-lg-15">
		            <div class="form-group row">
		              <label for="total_efectivo" class="col-sm-4 col-md-4 col-lg-6 control-label">Total Efectivo</label>
		              <div class="col-sm-4 col-md-4 col-lg-6">
		                <input type="text" class="form-control text-right" name="total_efectivo" id="total_efectivo" placeholder="" value="{{$data->total_efectivo}}" readonly>
		              </div>
		            </div>
		            <div class="form-group row">
		              <label for="inputtext3" class="col-sm-4   col-md-4 col-lg-6 control-label">Total Entregado</label>
		              <div class="col-sm-4 col-md-4 col-lg-6">
		                <input type="text" class="form-control text-right" name="total_entregado" id="total_entregado" required placeholder="" onchange="calcularSaldos();">
		              </div>
		            </div>

		            <div class="form-group row">
		              <label for="saldo_faltante" class="col-sm-4   col-md-4 col-lg-6 control-label">Saldo Faltante</label>
		              <div class="col-sm-4 col-md-4 col-lg-6">
		                <input type="text" class="form-control text-right" name="saldo_faltante" id="saldo_faltante" placeholder="" readonly>
		              </div>
		            </div>

		            <div class="form-group row">
		              <label for="saldo_sobrante" class="col-sm-4 col-lg-6 control-label">Saldo Sobrante</label>
		              <div class="col-sm-4 col-md-4  col-lg-6">
		                <input type="text" class="form-control text-right" name="saldo_sobrante" id="saldo_sobrante" placeholder="" readonly>
		              </div>
		            </div>
		        </div>

            </div>
            
            <div class="panel-footer">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            </div>
            </form>
        </div>
    </div>

</div>
@push('scripts')
<script>
	function calcularSaldos(){
    	total_efectivo=$("#total_efectivo").val();
    	total_entregado=$("#total_entregado").val();
    	//console.log(total_efectivo,total_entregado);
    	if(total_entregado > total_efectivo) {
    		saldo_faltante = 0;
    		saldo_sobrante = Number(total_entregado) - Number(total_efectivo);
    	}
    	if(total_entregado < total_efectivo) {
    		saldo_faltante = Number(total_efectivo)-Number(total_entregado);
    		saldo_sobrante = 0;
    	}
    	if(total_entregado == total_efectivo) {
    		saldo_faltante = 0;
    		saldo_sobrante = 0;
    	}
    	//console.log(saldo_faltante,saldo_sobrante);
    	$("#saldo_faltante").val(saldo_faltante);
    	$("#saldo_sobrante").val(saldo_sobrante);
	}
</script>
@endpush
@endsection