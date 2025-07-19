@extends ('layouts.admin')
@section ('contenido')

	<div v-cloak class="row">	
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Nueva FacturaEE</h3>
                @if (count($errors)>0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                	<li>{{$error}}</li>
                @endforeach
                </ul>
                </div>
                @endif

                {!!Form::open(['url'=>'ventas/factura','method'=>'POST','autocomplete'=>'off'])!!}
                {{Form::token()}}

                    @include('ventas.factura.partials.fields')                  	                       
                   
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit" @click="setHiddens">Finalizar</button>
                    <a class="btn btn-danger" href="{{url('ventas/factura')}}">Cancelar</a>
                  </div>

                {!!Form::close()!!}		

                </div>
	</div>
    @include('ventas.factura.partials.message')
    
@endsection

@section('js')
<script src="{{asset('js/bills.js')}}"></script>

    <script>
        $(".inputmask1").inputmask("(999) 9999999");
        $(".inputmask2").inputmask("(999) 999999999");
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true,
            viewMode: 'years'
        });

    </script>

@endsection