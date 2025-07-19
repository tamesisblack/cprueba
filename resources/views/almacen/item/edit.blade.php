@extends('layouts.admin')

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
    {!! Form::model($rsitems, ['route' => ['almacen.item.update', $rsitems],  'autocomplete' => 'off' , 'enctype'=>'multipart/form-data','method' => 'PUT']) !!}
    <div class="row">
            <div class="col-md-2">
                <div class="form-group has-success">
                     {!! Form::label('codigo', 'Código *') !!}
                    {!! Form::text('codigo', null, ['class' => 'form-control', 'readonly' => 'true', 'required']) !!}
                </div>
			</div>
            <div class="col-md-4">
                <div class="form-group">
                         {!! Form::label('nombre', 'Nombre *') !!}
						@if($type_view == 'Site')
							{!! Form::text('nombre', null, ['class' => 'form-control',  'readonly' => 'true','required']) !!}
						@else
							{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => '','required']) !!}
						@endif
                </div>
			</div>
            <div class="col-md-4">
				<div class="form-group">
                    {!! Form::label('descripcion', 'descripcion') !!}
                    
					@if($type_view == 'Site')
						{!! Form::text('descripcion', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
					@else
						{!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => '']) !!}
					@endif
                </div>
            </div
              <!-- /.col -->
             
              <!-- /.col -->
               
              <!-- /.col -->
			  
    </div>
    <div class="row">      
       @include('almacen.item.partials.adicionalesEdit')
    </div>
    <div class="for text-center">
		@if($type_view == 'Site')
			{!! Form::submit('Editar', ['class'=> 'btn btn-primary',  'disabled' => 'true']) !!}
		@else
			{!! Form::submit('Editar', ['class'=> 'btn btn-primary']) !!}
		@endif
        
        <a class="btn btn-danger" href="{{ route('item/master')}}">
            Cancelar
        </a>
    </div>
	<h6 style="font-size:0.15cm; ">INVITM2</h6>
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
    </script>
    @endpush
@endsection

 
