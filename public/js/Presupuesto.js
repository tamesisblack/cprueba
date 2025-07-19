$(document).ready(function () {
    var tokenCsrf = $( "input[name='_token']" ).val();
    var itemNow = 0;
    if(item_selected == "1"){
        RefreshTable();
    }

    $( "#save" ).click(function() {
        SaveData();
    });

    function SaveData() {
        $('#errorDiv').empty();

        if($( "#work_text" ).val() == "") {
            $( "#errorDiv" ).append('<div class="alert alert-danger"><ul><li>el campo REP/SERVICIO MANUAL es obligatorio</li></ul></div>');
            $('.alert-danger').delay(3000).fadeOut(); return 1;
        }

        if($( "#work_hours" ).val() == "") {
            $( "#errorDiv" ).append('<div class="alert alert-danger"><ul><li>el campo HORAS es obligatorio</li></ul></div>');
            $('.alert-danger').delay(3000).fadeOut(); return 1;
        }

        if($( "#work_price" ).val() == "") {
            $( "#errorDiv" ).append('<div class="alert alert-danger"><ul><li>el campo V.V.T ($.) es obligatorio</li></ul></div>');
            $('.alert-danger').delay(3000).fadeOut(); return 1;
        }
        //errorDiv

        $.ajax({
            url: urlSave,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': tokenCsrf},
            datatype: 'json',
            data:{
                numestim : $( "#numestim" ).val(),
                number_inventory : $( "#number_inventory" ).val(),
                category_id : $( "#category_id" ).val(),
                code_tipo : $( "#code_tipo" ).val(),
                work_id : $( "#work_id" ).val(),
                work_text : $( "#work_text" ).val(),
                work_hours : $( "#work_hours" ).val(),
                work_price : $( "#work_price" ).val(),
                item_selected : item_selected,
                itemNow : itemNow
                
            },
            success:function( respuesta ){
                $( "#work_text" ).val('');$( "#work_hours" ).val('');$( "#work_price" ).val('');
                $( "#save" ).html("Agregar");
                itemNow = 0;
                if(item_selected == "0"){window.location.href = urlShow+"/"+respuesta;}
                RefreshTable();
            }
        });
    }

    function RefreshTable() {
        $( "#tabla_items > tbody").empty();
        $.ajax({
            url: urlItems,
            type: 'GET',
            headers: {'X-CSRF-TOKEN': tokenCsrf},
            datatype: 'json',
            data:{ },
            success:function( respuesta ){
                if(respuesta){
                    for (let index = 0; index < respuesta.items.length; index++) {
                        item = respuesta.items[index];
                        categoria = '<td>'+item.category_id+'</td>';
                        tipo = '<td>'+ item.code_tipo+'</td>';
                        servicio_lista = '<td>'+ item.work.nombrelabor+'</td>';
                        servicio_manual = '<td>'+ item.work_text+'</td>';
                        horas = '<td>'+ item.work_hours+'</td>';
                        vvts = '<td>'+ item.work_price+'</td>';
                        action = '<td><button class="btn btn-primary edit_item">Editar</button><button class="btn btn-danger delete_item">Eliminar</button></td>'
                        data = 'data-id='+item.id;
                        $( "#tabla_items > tbody").append('<tr '+data+'>'+categoria+tipo+servicio_lista+servicio_manual+horas+vvts+action+'</tr>');
                    }
    
                    $( ".delete_item" ).click(function() {
                        deleteItem($(this).parent().parent().data('id'));
                    });
    
                    $( ".edit_item" ).click(function() {
                        $( "#save" ).html("Editar");
                        editItem($(this).parent().parent().data('id'));
                    });
                }

            }
        });
    }


    function deleteItem(id) {
        $.ajax({
            url: urlDelete+'/'+id,type: 'GET',headers: {'X-CSRF-TOKEN': tokenCsrf},
            datatype: 'json',data:{},
            success:function( respuesta ){RefreshTable();}
        });
    }

    function editItem(id) {
        $.ajax({
            url: urlItem+'/'+id,type: 'GET',headers: {'X-CSRF-TOKEN': tokenCsrf},
            datatype: 'json',data:{},
            success:function( respuesta ){
                itemNow = respuesta.id;
                $( "#work_text" ).val(respuesta.work_text);$( "#work_hours" ).val(respuesta.work_hours);$( "#work_price" ).val(respuesta.work_price);
                $( "#category_id" ).val(respuesta.category_id);$( "#code_tipo" ).val(respuesta.code_tipo);$( "#work_id" ).val(respuesta.work_id);
                console.log(itemNow);
            }
        });
    }


});
