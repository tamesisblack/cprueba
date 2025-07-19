@extends ('layouts.admin')
@section ('contenido')
<div class="col-md-6 col-md-offset-3">
	<div class="info-box">

	  <span class="info-box-icon bg-red"><i class="fa fa-undo"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text"><h3>Reversar recibo {{$receipt->receipt_number}} </h3></span>
	  
	    <hr>
	    {!!Form::open(['url'=>'ventas/reverseRecibo/' . $receipt->cash_receipt_id,'method'=>'post','autocomplete'=>'off', 'class' => ''])!!}

	    <input type="hidden" name="amount" value="{{$receipt->amount}}">

	    <input type="hidden" name="status" value="REVERSED">
	    
	    <input type="hidden" name="cash_receipt_id" value="{{$receipt->cash_receipt_id}}">

	    <input type="hidden" name="last_updated_by" value="{{Auth::user()->id}}">
	    
	    <input type="hidden" name="created_by" value="{{Auth::user()->id}}">

		<div class="form-group col-md-12">
		  <label for="date"  class="control-label">Fecha</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		        {!! Form::text('date', date_format(date_create(\Carbon\Carbon::now()),"Y-m-d"), ['class' => 'form-control datepicker']) !!}
		      </div>
		</div>		    

		<div class="form-group col-md-12">
		{!! Form::label('reason', 'Motivo del reverso') !!}
		{!! Form::textarea('reason',  null , ['class' => 'form-control', 'placeholder' =>'Motivo del reverso', 'rows' => '2']) !!}
		</div>	

			<button type="submit" class="btn btn-danger">Aceptar</button>
			<a href="/ventas/recibo"> <button class="btn btn-success">Cancelar</button></a>
	    {!!Form::close()!!}	
	  </div>

	</div>	
</div>

@endsection



