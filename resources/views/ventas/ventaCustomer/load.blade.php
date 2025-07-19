@extends('layouts.admin')

@section('title', 'Listado de vehiculos')

@section('contenido')

 <head>
  <title>Import Excel File in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head> 
    <div class="box">
		   @if(count($errors) > 0)
		<div class="alert alert-danger">
		 Upload Validation Error<br><br>
		 <ul>
		  @foreach($errors->all() as $error)
		  <li>{{ $error }}</li>
		  @endforeach
		 </ul>
		</div>
	   @endif

	   @if($message = Session::get('success'))
	   <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
			   <strong>{{ $message }}</strong>
	   </div>
	   @endif
	    
		
        <div class="box-header with-border">
            <h3 class="box-title">
                Registros de ultima Carga Realizadas
				
            </h3><br>
				Solo se permite .xls, .xslx
            <div class="box-tools">
                <div class="text-center">
                    
					<form method="post" enctype="multipart/form-data" action="{{ url('/loadrecords/import') }}">
						{{ csrf_field() }}
						<div class="form-group">
						 <table class="table">
						   
						  <tr>
						    <td width="50%" align="right"></td>
						   <td width="30"><span class="text-muted"> </span></td>
						   <td width="30%" align="left"></td>
							<td width="30"><a class="btn btn-success btn-sm" href="{{route('downloadformatLoadVeh')}}">
								DESCARGAR PLANTILLA
							</a> 
							</td>
						   <td width="40%" align="right"><label>Seleccione Informacion</label></td>
						   <td width="30">
							<input type="file" name="select_file" />
						   </td>
						   <td width="30%" align="left">
							<input type="submit" name="upload" class="btn btn-primary" value="Upload">
						   </td>
						  </tr>
						  <tr>
						   
						  </tr>
						 </table>
						</div>
					   </form> 
					    
                </div>
            </div>
        </div>
		<br>
		<div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
								<tr>
									<th>Fecha Creacion</th>
									<th>ID</th>
									<th>Placa</th>
									<th>Marca</th>
									<th>Modelo</th> 
									<th>Num Motor</th>
									
									  
								</tr>
                            </thead>
                            <tbody>
								@foreach($data as $row)
								   <tr>
									<td>{{ $row->created_at}}</td>
									<td>{{ $row->id  }}</td>
									<td>{{ $row->placa }}</td>
									<td>{{ $row->marca->nombre }}</td>
									<td>{{ $row->modelo->nombre  }}</td> 
									<td>{{ $row->num_motor }}</td>
								   </tr>
							   @endforeach
						
                            </tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
        </div>
		 
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection