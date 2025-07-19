@extends ('layouts.admin')
@section ('contenido')
<div class="row" v-cloak>	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Plazos</h3>
    <div class="col-md-12">    
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">
                Factura {{ $bill->trx_number}}
            </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
                <h4><strong>Cliente: </strong> {{ $bill->billTo}}</h4>
                <h4><strong>Importe Total: </strong> {{ number_format($bill->amount, 2)}}</h4>
                <input type="hidden" value="{{$bill->customer_trx_id}}" ref="customer_trx_id">
                <input type="hidden" value="{{$bill->amount}}" ref="amount">
          </div>
          <!-- box-footer -->
        </div>
        <!-- /.box -->        
    </div>

            @include('ventas.plazo.partials.fields')
          <div class="form-group col-md-12" v-if="total > 0">
            <button class="btn btn-primary" type="submit" @click="save" :disabled="remain != 0">Guardar</button>
            <a class="btn btn-danger" href="{{url('ventas/factura')}}">Cancelar</a>
          </div>

        </div>
</div>

@endsection

@section('js')
<script src="{{asset('js/terms.js')}}"></script>
<script>
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true,
            viewMode: 'years'
        });
    
</script>
@endsection