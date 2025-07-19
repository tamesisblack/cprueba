@extends ('layouts.admin')
@section ('contenido')

	<div class="row">	
                <div class="col-md-8 col-md-offset-2">
                <h3>Asociar usuarios y sucursales</h3>
                @if (count($errors)>0)
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                	<li>{{$error}}</li>
                @endforeach
                </ul>
                </div>
                @endif


                    @include('usersite.partials.fields')                  	                       
                   
                  <div class="form-group">
                    <button class="btn btn-primary" @click="store" :disabled="userSites.length == 0">Finalizar</button>
                    <a class="btn btn-danger" href="{{url('/home')}}">Cancelar</a>
                  </div>	

                </div>
	</div>
    
@endsection

@section('js')
<script src="{{asset('js/user-sites.js')}}"></script>
<script type="text/javascript">
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true,
            viewMode: 'years'
        });
    
</script>

@endsection