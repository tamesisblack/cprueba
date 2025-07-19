@extends('layouts.admin')

@section('title', 'Registro de Articulo')

@section('contenido')
<style type="text/css">
    .upload_btn{
    position:absolute;
    width:200px;
    height:40px;
    margin-top:-40px;
    z-index:10;
    opacity:0;
}
</style>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <!--<h4>Nuevo Artículo</h4>-->
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

    {!! Form::open(['route' => 'almacen.item.store', 'class' => 'form', 'autocomplete' => 'off' , 'enctype'=>'multipart/form-data', 'method' => 'POST', 'id' => 'form']) !!}

    <div class="row">
		  <div class="col-md-2">
			<div class="form-group has-error">
			   {!! Form::label('codigo', 'Códigod') !!}
				{!! Form::text('codigo', 'AUTOMATICO_CATEGORIA', ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
			</div>
			<!-- /.form-group -->
			
			<!-- /.form-group -->
		  </div>
		  <!-- /.col -->
		  <div class="col-md-4">
			<div class="form-group">
				{!! Form::label('nombre', 'Nombre') !!}
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
			</div>			 
		  </div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('descripcion', 'descripcion') !!}                      
				{!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => '']) !!}
			 
			</div>
		</div>
		  <!-- /.col -->
		  
		  <!-- /.col -->
	</div>
    <div class="row">      
       @include('almacen.item.partials.adicionalesCreate')
    </div>

     
    <div class="for text-center">
        {!! Form::submit('Registrar', ['class'=> 'btn btn-primary']) !!}
        <a class="btn btn-danger" href="{{ route('almacen.item.index')}}">Cancelar</a>
    </div>
	<h6 style="font-size:0.15cm; ">INVITM1</h6>
    {!! Form::close() !!}

    @push ('scripts')
<script>

	//SElECT CON FILTRO
        $(document).ready(function() {
        $(".select2").select2();
        });
		
		
     function imagen(index){
                 $('#file_input_'+index).trigger('click');

                 $('#file_input_'+index).change(function(e) {
                  addImage(e,index); 
                 });

            }
            function addImage(e,index){
                 var file = e.target.files[0];
                 imageType = /image.*/;
                 if (!file.type.match(imageType))
                        return;
                 var reader = new FileReader();
                  reader.onload = function(e) {
                    var img = document.getElementById('img_'+index);
                    img.src= event.target.result;
                  }
                  reader.readAsDataURL(file);

            }
$('#liAlmacen').addClass("treeview active");
$('#limItems').addClass("treeview active");
$('#lismItems').addClass("active");
</script>
@endpush

@endsection

 
@section('js')
    <script type="text/javascript">
         
       

        //SElECT CON FILTRO
        $(document).ready(function() {
        $(".select2").select2();
        });
		
		
        
     
    </script>
@endsection
