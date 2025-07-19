@extends('layouts.admin')

@section('title', 'Editar Sucursal')

@section('contenido')
    {!! Form::model($rssite, ['route' => ['configuracion.site.update', $rssite], 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                     
                    <h3 class="box-title">EDITAR SUCURSAL   </h3>
                </div>
				<div class="box-body">
					<div class="nav-tabs-custom"> 
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_1" data-toggle="tab">INF. GENERAL</a>
							</li>
							<li>
								<a href="#tab_2" data-toggle="tab">INF. CONTABLE</a>
							</li>
							
							<li>
								<a href="#tab_3" data-toggle="tab">FACTURACION ELECTRONICA</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">								 
								<div class="row">
									<div class="col-md-12">
									 
										<!--Contenido-->
										@include('configuracion.site.partials.fields')
									  
									</div> 									
								</div>
								 
							</div>
							<div class="tab-pane" id="tab_2">
								 
									<div class="row">
										<div class="col-md-12">
											<!--Contenido-->									
											@include('configuracion.site.partials.datosaccounting')												
											 
										</div>              
									</div>
								 
							</div>
							
							<div class="tab-pane" id="tab_3">
								 
									<div class="row">
										<div class="col-md-12">
											<!--Contenido-->									
											 								
											@include('configuracion.site.partials.datosfacele')
											@include('configuracion.site.partials.datosBOLele')
											
										</div>              
									</div>
								 
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>

    <div class="for text-center">
        {!! Form::submit('Editar', ['class'=> 'btn btn-primary']) !!}


        
        <a class="btn btn-danger" href="{{ route('configuracion.site.index')}}">
            Cancelar
        </a>
    </div>

    {!! Form::close() !!}
@endsection

 @section('js')
<script>

		$(window).load(function(){
			// PROCESO PARA CARGAR VISTA PREVIA DE IMAGE SUCURSAL
			 $(function() {
					  $('#path_image_logo').change(function(e) {
					      addImage(e); 
					     });

				     function addImage(e){
				      var file = e.target.files[0],
				      imageType = /image.*/;
				    
				      if (!file.type.match(imageType))
				       return;
				  
				      var reader = new FileReader();
				      reader.onload = fileOnload;
				      reader.readAsDataURL(file);
				     }
			  
				     function fileOnload(e) {
				      var result=e.target.result;
				      $('#imgSalida').attr("src",result);
				     }

			    });
	  	});

</script>
@endsection