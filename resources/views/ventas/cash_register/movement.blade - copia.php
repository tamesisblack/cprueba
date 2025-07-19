<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/select2.min.css')}}">
@extends('layouts.admin')
@section('title', 'Punto de Venta')
@section('contenido')
<div class="row">
    <div class="col-md-12">
         <div class="box box-primary">
             <div class="box-header with-border">
                 <h3>MOVIMIENTO DE CAJA</h3>
             </div>             
            @if(isset($kit))
                <form id="kitPromo" action="{{route('cash.update',['id' => $kit['kit'][0]->id])}}" method="post" class="form form-horizontal">
            @else    
                <form id="cashMovement" method="post" action="{{route('cash.movementStore')}}">
            @endif
            {{csrf_field()}}
             <div class="box-body">
                <div class="form-group row">
                    <label for="nameCash" class="col-sm-2 col-form-label">Nombre Caja</label>
                    <div class="col-sm-10">
                        <select id="nameCash" name="nameCash" class="form-control">
                            <option value="-1">Seleccionar</option>
                            @foreach($cash as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Tipo de Operación</label>
                    <div>
                        <div class="col-sm-4">
                          <!-- checkbox -->
                          <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="retiro" name="tipo">
                              <label class="form-check-label">Retiro de dinero</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- radio -->
                          <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" checked type="radio" value="ingreso" name="tipo">
                              <label class="form-check-label">Ingreso de dinero</label>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-3">
					<div class="form-group">
						<label>**Tipo de Movimiento</label>
						<select name="type_movement" id="type_movement" class="form-control">
									<option value=""></option>
									<option value="ingreso"  >Ingreso de Dinero</option>
									<option value="retiro"  >Retiro de Dinero</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<label for="reason_id">**Motivo</label>					 
					<select name="reason_id" id="reason_id" class="form-control reason_id" style="width: 100%">
						<option></option>
					</select>
				</div>
				
                <div class="col-md-3">
                    <label for="total" class="col-sm-2 col-form-label">Importe</label>
                     
                        <input name="importe" type="text" class="form-control" name="venta_abono_reg" id="importe" value="0.00" pattern="[0-9.]{1,25}" maxlength="25">
                  
                </div>
                <div class="form-group row">
					 <div class="col-sm-10">
                    <label for="total" class="col-sm-2 col-form-label">Motivo de movimiento</label>
                   
                        <textarea name="motivo" class="form-control" rows="5" cols="50"></textarea>
                    </div>
                </div>
                
             </div>
             <div class="box-footer">
                <a onclick="save()" class="btn btn-info">Aceptar</a>
                <a href="{{route('cash.index')}}" class="btn btn-default float-right">Cancelar</a>
             </div>
         </form>
         </div>
    </div>
</div>
<!------End modal de cliente----------------------------------------------->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">

let validate = 0;
	
	$("select[name='type_movement']").change(function () {
            var type_movement = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "{{route('select-ajax-mov')}}",
                method: 'POST',
                data: {type_movement: type_movement, _token: token},
                success: function (data) {
                    $("select[name='reason_id'").html('');
                    $("select[name='reason_id'").html(data.options);
                }
            });
        });
			
	 

    function save(){  
        var cash = $('#nameCash').val();
        var tipo = $('input[name="tipo"]:checked').val();

        if(cash == '-1'){
            message('Alerta', `Favor de seleccionar una caja.`, 'warning');
            validate++;
        }

        if(tipo == 'retiro' && validate == 0){
            valMont();
        }else{
            console.log(validate);
            if(validate == 0){
                document.getElementById("cashMovement").submit();
                message('Alerta', `Movimiento registrado`, 'success');
            }
        }

        
        validate = 0;
    }

    function valMont(){
        var id = $('#nameCash').val();
        var monto = $('#importe').val();

        var url="{{ url('/cash/valMont/') }}/"+id+'/'+monto;
        $.get(url, function(res) {
            var obj = $.parseJSON(res);
            if(!obj){
                message('Alerta', `El total acumulado de la caja No es mayor al importe a retirar`, 'warning');
            }else{
                document.getElementById("cashMovement").submit();
                message('Alerta', `Movimiento registrado`, 'success');
            }
        });
    }

//---Alertas del sistema----------------------------------------------------------------------------
    const message = function(title, body, type = 'info', op = 2 , time = 2000) {
       toastr.options.progressBar = true;
                switch (type) {
                    case 'success':
                        toastr.success(`${body}`, `${title}`, {
                            timeOut: time
                        });
                        break;
                    case 'warning':
                        if(op == 2){
                             toastr.warning(`${body}`, `${title}`, {
                                timeOut: time
                            });
                        }else{
                            toastr.warning(`${body}`, `${title}`, {
                            closeButton: true,
                            debug: false,
                            newestOnTop: false,
                            progressBar: false,
                            positionClass: "toast-top-center",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            timeOut: 0,
                            extendedTimeOut: 0,
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: false
                            });
                        }
                        break;
                    case 'error':
                        toastr.error(`${body}`, `${title}`, {
                            timeOut: time
                        });
                        break;
                    default:
                        toastr.info(`${body}`, `${title}`, {
                            timeOut: time
                        });
                        break;
                }
    }
</script>
@endsection
