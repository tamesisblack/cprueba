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
                 <h3>CAJA</h3>
             </div>             
            @if(isset($kit))
                <form id="kitPromo" action="{{route('cash.update',['id' => $kit['kit'][0]->id])}}" method="post" class="form form-horizontal">
            @else    
                <form id="cashRegister" method="post" action="{{route('cash.registerStore')}}">
            @endif
            {{csrf_field()}}
             <div class="box-body">
                <div class="form-group row">
                    <label for="nameCash" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control">
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

    function save(){   
        var cash = $('#name').val();

        if(cash == ''){
            message('Alerta', `Favor insertar un nombre.`, 'warning');
            validate++;
        }

        if(validate == 0){
            document.getElementById("cashRegister").submit();
            message('Alerta', `Caja registrada`, 'success');
        }
        validate == 0;
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
