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
                 <h3>APERTURA DE CAJA</h3>
             </div>             
            @if(isset($kit))
                <form id="kitPromo" action="{{route('cash.update',['id' => $kit['kit'][0]->id])}}" method="post" class="form form-horizontal">
            @else    
                <form id="cashOppen" method="post" action="{{route('cash.store')}}">
            @endif
            {{csrf_field()}}
             <div class="box-body">
                <div class="form-group row">
                    <label for="nameCash" class="col-sm-2 col-form-label">Nombre Caja</label>
                    <div class="col-sm-10">
                        <select onclick="valCash()" id="nameCash" name="nameCash" class="form-control">
                            <option value="-1">Seleccionar</option>
                            @foreach($cash as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="personal" class="col-sm-2 col-form-label">Personal Asignado</label>
                    <div class="col-sm-10">
                        <select id="personal" name="personal" class="form-control">
                            <option value="-1">Seleccionar</option>
                            @foreach($per_people as $item)
                            <option value="{{$item->PERSON_ID}}">{{$item->FULL_NAME}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total" class="col-sm-2 col-form-label">Importe Inicial</label>
                    <div class="col-sm-10">
                        <input name="importe" type="text" class="form-control" name="venta_abono_reg" id="importe" value="0.00" pattern="[0-9.]{1,25}" maxlength="25">
                    </div>
                </div>
                
             </div>
             <div class="box-footer">
                <a onclick="confirmacion()" class="btn btn-info">Apertura Caja</a>
                <a href="{{route('cash.index')}}" class="btn btn-default float-right">Cancelar</a>
             </div>
         </form>
         </div>
    </div>
</div>
<div class="modal fade" id="modal-caja">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" onclick="closeModal('caja')">
                   <span aria-hidden="true">&times;</span>
               </button>
               <h4 class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group text-center">
                        <div class="col-md-12">
                           <h2><p id="texto"></p></h2>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-striped">
                           <tbody id="products"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <a class="btn btn-primary" onclick="save()">SI</a>
                <a class="btn btn-danger" onclick="closeModal('caja')">No</a>
            </div>
        </div>
    </div>
</div>
<!------End modal de cliente----------------------------------------------->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">

let validate = 0;

  //==Activar modal===============================
    function closeModal(nameModal){
        $('#modal-'+nameModal).modal('hide');
    }
    //==Ocultar modal============================================
    function showModal(nameModal){
        $('#modal-'+nameModal).modal('show');
    }

function confirmacion(){
    var combo = document.getElementById("nameCash");
    var selected = combo.options[combo.selectedIndex].text;
    var selectVal = combo.options[combo.selectedIndex].value;
    var personal = $('#personal').val();

        if(selectVal == '-1'){
            message('Alerta', `Favor de seleccionar una caja.`, 'warning');
            validate++;
        }

        if(personal == '-1'){
            message('Alerta', `Favor de seleccionar personal.`, 'warning');
            validate++;
        }

        if(validate == 0){
            document.getElementById('texto').innerHTML= `¿Desea aperturar la caja ${selected}?`;
            showModal('caja');            
        }
        validate = 0;

   
    /*message('Alerta', `clear itself ? ¿Desea aperturar la caja ${selected}?<br /><br /><a href="#" onclick="save()" class="btn clear">SI</a>&nbsp;&nbsp;&nbsp;`, 'warning',1);*/
    //<button type="button" class="btn clear">No</button>
}
    function save(){   
        document.getElementById("cashOppen").submit();
        message('Alerta', `Apertura de caja realizada`, 'success');
        closeModal('caja');
        /*var cash = $('#nameCash').val();
        var personal = $('#personal').val();
        closeModal('caja');
        if(cash == '-1'){
            message('Alerta', `Favor de seleccionar una caja.`, 'warning');
            validate++;
        }else{
            valCash();
        }
        if(personal == '-1'){
            message('Alerta', `Favor de seleccionar personal.`, 'warning');
            validate++;
        }

        if(validate == 0){
            document.getElementById("cashOppen").submit();
            message('Alerta', `Apertura de caja realizada`, 'success');
        }
        validate == 0;*/
    }

    function valCash(){  
        var cash = $('#nameCash').val();

        if(cash != '-1'){
            var url="{{ url('/cash/valCahs/') }}/"+cash;
             console.log(url);
            $.get(url, function(res) {
                var obj = $.parseJSON(res);
                if(obj == 'OPEN'){
                    message('Alerta', `La caja actualmente se encuentra abierta.`, 'error');
                    $('#nameCash').val(-1);
                }
              });
            }
         
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
