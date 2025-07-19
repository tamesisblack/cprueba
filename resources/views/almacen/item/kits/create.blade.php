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
                 <h3>KITS/PROMOCIONES</h3>
             </div>             
            @if(isset($kit))
                <form id="kitPromo" action="{{route('kits.update',['id' => $kit['kit'][0]->id])}}" method="post" class="form form-horizontal">
            @else    
                <form id="kitPromo" method="post" action="{{url('kits')}}">
            @endif
            {{csrf_field()}}
             <div class="box-body">
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="idRegistro" value="{{isset($kit) ? $kit['kit'][0]->id : 0}}">
                        <input type="text" value="{{isset($kit) ? $kit['kit'][0]->nombre : ''}}" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Estado Promoción</label>
                    <div>
                        <div class="col-sm-4">
                          <!-- checkbox -->
                          <div class="form-group">
                            <div class="form-check">
                              @if(isset($kit))
                                @if($kit['kit'][0]->estatus == 'Active')
                                 <input class="form-check-input" checked type="radio" value="Active" name="estatus">
                                @else
                                 <input class="form-check-input" type="radio" value="Active" name="estatus">
                                @endif
                              @else
                                <input class="form-check-input" checked type="radio" value="Active" name="estatus">
                              @endif  
                              <label class="form-check-label">Activo</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- radio -->
                          <div class="form-group">
                            <div class="form-check">
                                @if(isset($kit))
                                    @if($kit['kit'][0]->estatus == 'Inactive' || $kit['kit'][0]->estatus == null)
                                    <input class="form-check-input" checked type="radio" value="Inactive" name="estatus">
                                    @else
                                    <input class="form-check-input" type="radio" value="Inactive" name="estatus">
                                    @endif
                                @else
                                    <input class="form-check-input" type="radio" value="Inactive" name="estatus">
                                @endif
                              <label class="form-check-label">Inactivo</label>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Stock</label>
                    <div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">Mínimo</label>
                                <input onclick="numero('min')" onkeyup="numero('min')" type="number" class="form-control" value="{{isset($kit) ? $kit['kit'][0]->min : 1}}"  name="min" id="min"> 
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">Máximo</label>
                                <input onclick="numero('max')" onkeyup="numero('max')" type="number" class="form-control" value="{{isset($kit) ? $kit['kit'][0]->max : 1}}" name="max" id="max"> 
                            </div>
                          </div>
                        </div>
                    </div>
                </div>-->
                <div class="form-group row">
                    <label for="total" class="col-sm-2 col-form-label">Total Kit</label>
                    <div class="col-sm-2">
                        <input type="hidden" name="totalH" id="totalH" value="{{isset($kit) ? intval($kit['kit'][0]->total) : 0}}">
                        <input  value="{{isset($kit) ? ($kit['kit'][0]->total) : 0}}" disabled type="text" class="form-control" id="total" name="total" placeholder="Total Kit">
                    </div>
                </div>
                <!--<div class="form-group">
                <label>Minimal</label>
                <select onclick="prueba()" id="pruebaSelect" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>-->
                <div class="step">
                    <span class="bs-stepper-label">Detalle de Productos</span>
                </div>
                <input type="hidden" id="datos" value="{{json_encode($data)}}">
                <input type="hidden" id="materiales" value="{{ isset($kit) ? json_encode($kit['kit']) : 0}}">
                <input type="hidden" name="numFilas" id="numFilas" value="{{isset($kit) ? count($kit['kit']) : 0}}">
                <div class="table-responsive">
                    <table id="table1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Material</th>
                                <th>Cantidad</th>
                                <th>Unidad de Medida</th>
                                <th>Precio Real</th>
                                <th>Precio Cliente</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="filas">
                            @if(isset($kit))
                            @else
                            <tr id="artc_0">
                                <td width="10%">
                                   <div class="btn-group">
                                        <a id="add_0" onclick="addItem(0)" class="btn btn-info btn-flat">
                                          <i class="fa fa-plus-circle"></i>
                                        </a>
                                        <a id="delete_0" onclick="destroy(0)" style="display:none" class="btn btn-danger btn-flat">
                                          <i class="fa fa-minus-circle"></i>
                                        </a>
                                    </div>
                                </td>
                                <td width="35%">
                                    <input type="hidden" name="idMaterial[]" id="idMaterial_0" value="0">
                                    <select onclick="selectItem(0)" class="form-control" name="items" id="item_0">
                                        <option value="-1" selected="selected">Seleccionar</option>
                                        @foreach($data as $item){
                                        <option value="{{$item['inv_item_id']}}">{{$item['nombre']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="10">
                                    <input class="form-control" onclick="contCantidad(0)" onkeyup="contCantidad(0)" type="number" name="cantidad[]" id="cantidad_0" value="0">
                                </td>
                                <td width="10%">
                                   <input class="form-control" type="text" name="unidad[]" id="unidad_0" value="" disabled>
                                </td>
                                <td width="10%">
                                    <input type="text" class="form-control" name="precio_r[]" id="precio_r_0" value="" disabled>
                                </td>
                                <td width="10%">
                                    <input  onclick="contCantidad(0)" onkeyup="contCantidad(0)" pattern="[0-9.]{1,25}" class="form-control" maxlength="25" type="text" name="precio_c[]" id="precio_c_0" value="0.00">
                                </td>
                                <td width="10%">
                                   <input class="form-control" type="text" name="subtotal[]" id="subtotal_0" value="" disabled>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
             </div>
             <div class="box-footer">
                <a onclick="save()" class="btn btn-info">Guardar</a>
                <a href="{{route('almacen.index')}}" class="btn btn-default float-right">Cancelar</a>
             </div>
         </form>
         </div>
    </div>
</div>
<!------End modal de cliente----------------------------------------------->
@endsection
@section('js')
<!-- Select2 -->
<script type="text/javascript" src="{{ asset('AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    let artc = [];
    let inputSelect = '';
    let materialAdds = [];
    let valMaterial = 0;

   /* $(document).on('ready', function(){
        $('select').select2();
    });
*/
   /* $('body').on('DOMNodeInserted'.'select', function(){
        $(this).select2();
    });*/

    function prueba(){
        console.log('hola prueba');
    }

/*$('select').on('select2:select', function (e) { 
    console.log(e.params);
});*/

    $(function () {
        //Initialize Select2 Elements
        //$(".select2").select2();

        var tempItems = $.parseJSON($('#datos').val());
        var idRegistro = $('#idRegistro').val();
        var materiales = $.parseJSON($('#materiales').val());

        inputSelect += `<option value="-1">Seleccionar</option>`;
        for(var i = 0; i < tempItems.length; i++){
            artc.push({id: tempItems[i].inv_item_id, nombre:tempItems[i].nombre, cantidad: 1, unidad: tempItems[i].primary_uom_code, precio_r: tempItems[i].list_price_per_unit });
            inputSelect += `<option value="${tempItems[i].inv_item_id}">${tempItems[i].nombre}</option>`;
        }

        if(idRegistro != 0){
            var cantidadRegis = $('#numFilas').val();
            for(var i = 0; i < cantidadRegis; i++){
                estructur(i);
                if(i == (cantidadRegis-1)){
                    document.getElementById('add_'+(i)).style.display = 'block';
                    document.getElementById('delete_'+(i)).style.display = 'block';
                }else{
                    document.getElementById('add_'+(i)).style.display = 'none';
                    document.getElementById('delete_'+(i)).style.display = 'block';
                }
                materialAdds.push({id : materiales[i].idMaterial});
                $('#unidad_'+i).val(materiales[i].unidadMaterial);
                $('#cantidad_'+i).val(Number(materiales[i].cantidad)); 
                $('#idMaterial_'+i).val(materiales[i].idMaterial);
                $('#precio_r_'+i).val(materiales[i].precio_r);
                $('#precio_c_'+i).val(materiales[i].precio_c);
                $('#item_'+i).val(materiales[i].idMaterial)
                $('#subtotal_'+i).val((Number(materiales[i].cantidad) * materiales[i].precio_c).toFixed(2))
            }
            $('#numFilas').val(cantidadRegis-1);
        }

        
    });

    function save(){
        let validate = 0;
        var numeF = $('#numFilas').val();
        var ultMaterial = $('#item_'+numeF).val();
        var ultPrecioC = $('#precio_c_'+numeF).val();

        if($('#nombre').val() == ''){
             message('Nombre', `Favor de ingresar el nombre.`, 'error');
            validate++;
        }else if(Number($('#totalH').val()) < 1){
            message('Materiales', `Favor de ingresar materiales.`, 'error');
            validate++;
        }else if(ultMaterial != '-1' && ultPrecioC < 1){
            message('Material', `Favor de ingresar el precio cliente.`, 'error');
            validate++;
        }

        if(validate == 0)
            document.getElementById("kitPromo").submit();
    }

    function numero(campo){
        var datoCampo = $('#'+campo).val();
        if(datoCampo < 1)
             $('#'+campo).val(1);
    }

    function contCantidad(row){
        var cantidad = $('#cantidad_'+row).val();
        if(cantidad < 1)
            $('#cantidad_'+row).val(1);
        calTotal();
    }

    function calTotal(){
        var numeF = $('#numFilas').val();
        numeF++;
        var total = 0;
        for(var i = 0 ; i < numeF; i++){
            if($('#cantidad_'+i).val() != undefined){
                var precioCliente = $('#precio_c_'+i).val();
                if(precioCliente == '')
                    precioCliente = 0;
                
                total += (parseFloat($('#cantidad_'+i).val()) * parseFloat(precioCliente));
                $('#subtotal_'+i).val(((parseFloat($('#cantidad_'+i).val()) * parseFloat(precioCliente))).toFixed(2));
            }
        }
        $('#totalH').val(total.toFixed(2));
        $('#total').val(total.toFixed(2));
    }

    function selectItem(row){
        var dataSelect = $('#item_'+row).val();
        if(dataSelect != '-1'){
            var resSelect = artc.find(r => r.id == Number(dataSelect));
            var busquedaMaterial = materialAdds.find(p => p.id == Number(dataSelect));
            console.log(busquedaMaterial);
            if(busquedaMaterial == undefined){
                valMaterial = 0;
                //materialAdds.push({id : dataSelect});
                document.getElementById('delete_'+(row)).style.display = 'block';
                
                $('#unidad_'+row).val(resSelect.unidad);
                $('#cantidad_'+row).val(1);
                $('#idMaterial_'+row).val(resSelect.id);
                $('#precio_r_'+row).val(resSelect.precio_r);
                $('#precio_c_'+row).val(resSelect.precio_r);
                calTotal();

            }
            else{
                valMaterial = 1;
                $('#item_'+row).val(-1);
                $('#unidad_'+row).val(0);
                $('#cantidad_'+row).val(0);
                $('#idMaterial_'+row).val(0);
                $('#precio_r_'+row).val('0.00');
                $('#precio_c_'+row).val('0.00');
                materialAdds.splice(row,1);
                calTotal();
                message('Material', `Ya se cuentra agregado el material seleccionado.`, 'warning'); 
            }

           
        }else
            materialAdds.splice(row,1);
    }

    function destroy(row){
        var cantidad =  parseFloat($('#cantidad_'+row).val()); 
        var precio = parseFloat($('#precio_c_'+row).val());
        var total = parseFloat($('#totalH').val());
        var numeF = $('#numFilas').val();
        $('#totalH').val((total-(cantidad*precio)).toFixed(2));
        $('#total').val((total-(cantidad*precio)).toFixed(2));
        if(row < numeF ){
            var busquedaMaterial = materialAdds.find(p => p.id == Number( $('#item_'+row).val() ));
            busquedaMaterial.id = 0;
            $('#artc_'+row).remove();
        }else{
            $('#item_'+row).val(-1);
            $('#unidad_'+row).val(0);
            $('#cantidad_'+row).val(0);
            $('#idMaterial_'+row).val(0);
            $('#precio_r_'+row).val('0.00');
            $('#precio_c_'+row).val('0.00');
            $('#subtotal_'+row).val('0.00');
            document.getElementById('delete_'+(row)).style.display = 'none';
        }
       
       
        message('Material', `Eliminado de la lista`, 'warning');
    }

    function estructur(numFila){
       
            var table = document.getElementById("table1");
            var tr = table.insertRow(-1);
            tr.setAttribute("id", "artc_"+numFila);

            var td1 = tr.insertCell();
            td1.setAttribute('width','10%');
            td1.innerHTML= `<div class="btn-group">
                                <a id="add_${numFila}" onclick="addItem(${numFila})" class="btn btn-info btn-flat">
                                     <i class="fa fa-plus-circle"></i>
                                </a>
                                <a id="delete_${numFila}" onclick="destroy(${numFila})" style="display:none" class="btn btn-danger btn-flat">
                                    <i class="fa fa-minus-circle"></i>
                                </a>
                            </div>`;

            var td2 = tr.insertCell();
            td2.setAttribute('width','35%');
           // td2.setAttribute('on',`selectItem(${numFila})`);
            td2.innerHTML= `<input type="hidden" name="idMaterial[]" id="idMaterial_${numFila}" value="0">
                            <select onclick="selectItem(${numFila})" class="form-control" name="items" id="item_${numFila}">
                                ${inputSelect}
                            </select>`;

            var td3 = tr.insertCell();
            td3.setAttribute('width','10%');
            td3.innerHTML= `<input type="number"  onclick="contCantidad(${numFila})" onkeyup="contCantidad(${numFila})" class="form-control" name="cantidad[]" id="cantidad_${numFila}" value="0">`;

            var td4 = tr.insertCell();
            td4.setAttribute('width','10%');
            td4.innerHTML= ` <input type="text" class="form-control" name="unidad[]" id="unidad_${numFila}" value="" disabled>`;

            var td5 = tr.insertCell();
            td5.setAttribute('width','10%');
            td5.innerHTML=`<input type="text" class="form-control" name="precio_r[]" id="precio_r_${numFila}" value="" disabled>`;

            var td6 = tr.insertCell();
            td6.setAttribute('width','10%');
            td6.innerHTML= `<input onclick="contCantidad(0)" onkeyup="contCantidad(0)" type="text" class="form-control" pattern="[0-9.]{1,25}" maxlength="25" name="precio_c[]" id="precio_c_${numFila}" value="0.00">`;


            var td6 = tr.insertCell();
            td6.setAttribute('width','10%');
            td6.innerHTML= `<input class="form-control" type="text" name="subtotal[]" id="subtotal_${numFila}" value="" disabled>`;

            /*$('select').select2();

            $(document).on('ready', function(){
                $('select').select2();
            });*/

            /*$('#idMaterial_'+numFila).select2({
                placeholder: 'P',
                tags: true,
                tokenSeparators: [',']
            });  */
           // $('#idMaterial_'+numFila).select2(); 
          // $(".select2").select2(); 
    }

    function addItem(row){
        var primerItem = $('#item_'+row).val();
        var precio_c = parseFloat($('#precio_c_'+row).val());
        var numFila = (Number($('#numFilas').val()))+1;
        if(primerItem != '-1'){
            if(precio_c > 0){                
                if(valMaterial != 0)
                    message('Material', `Ya se cuentra agregado el material seleccionado.`, 'warning'); 
                else{
                    document.getElementById('add_'+(numFila-1)).style.display = 'none';
                    document.getElementById('delete_'+(numFila-1)).style.display = 'block';
                    estructur(numFila);
                    calTotal();
                    materialAdds.push({id : primerItem});
                    $('#numFilas').val(numFila);
                }

            }else
                message('Material', `Favor de ingresar el precio cliente.`, 'warning'); 
           
        }else
            message('Material', `Favor de seleccionar un material.`, 'warning');  
    }
//---Alertas del sistema----------------------------------------------------------------------------
    const message = function(title, body, type = 'info', time = 2000) {
       toastr.options.progressBar = true;
                switch (type) {
                    case 'success':
                        toastr.success(`${body}`, `${title}`, {
                            timeOut: time
                        });
                        break;
                    case 'warning':
                        toastr.warning(`${body}`, `${title}`, {
                            timeOut: time
                        });
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
