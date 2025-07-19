
{!! Form::open(['url'=>'ventas/factura','method'=>'GET','autocomplete'=>'off','role'=>'search', 'name' => 'buscar']) !!}

<div class="col-sm-4 col-xs-12">
	<div class="info-box">
	  <span class="info-box-icon bg-aqua info-search"><i class="fa fa-users"></i></span>
	  <div class="info-box-content">

		<div class="form-group">
			<label for="client">Cliente</label>
			<input type="text" class="form-control" name="client" placeholder="Nombre / Codígo" value="{{$client}}">				
			<br>
			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>	
		</div>
	  
	  </div>
	</div>	
</div>

<div class="col-sm-4 col-xs-12">
	<div class="info-box">
	  <span class="info-box-icon bg-red info-search"><i class="fa fa-tasks"></i></span>
	  <div class="info-box-content">

		<div class="form-group">
		<label for="trxStart">Transacciones</label>
			<input type="text" class="form-control" name="trxStart" placeholder="Inicio" value="{{$trxStart}}">
			<br>
	 		<input type="text" class="form-control" name="trxEnd" placeholder="Fin" value="{{$trxEnd}}">	
		</div>

	  </div>
	</div>	
</div>

<div class="col-sm-4 col-xs-12">	

	<div class="info-box">
	  <span class="info-box-icon bg-green info-search"><i class="fa fa-calendar"></i></span>
	  <div class="info-box-content">

		<div class="form-group">
		  <label for="trx_date"  class="control-label">Fecha</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('dateStart', null, ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
		      </div>
			<br>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('dateEnd', null, ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
		      </div>	      
		</div>	
	  </div>
	</div>	
</div>

	



<div class="clearfix"></div>
{{Form::close()}}
  