$(document).ready(function () {
    $("#btn_return").on('click', function(event)
    {
        event.preventDefault();
        
            var checkboxes = document.getElementById("form1").checkbox;
                        
            //console.log(checkboxes.length);
            /* console.log(as.toString());
            return true; */
            var data = new Object();
            var cont = 0;
            if(checkboxes.length == undefined)
            {
                //alert('here');
                if (checkboxes.checked)
                {
                    
                    cont = cont + 1;
                    data = new Object();
                    
                    data.material_id = checkboxes.value;
                    var quantity = document.getElementById("form1").elements["quantity_return[]"];
                    if(quantity.value == 0)
                    {
                        swal('la cantidad a devolver debe ser mayor a 0 ' , "error");
                        
                        return true;
                    }
                    else
                    {
                        var status = document.getElementById("form1").elements["item_status[]"];
                        var name_material = document.getElementById("form1").elements["name_material[]"];
                        if(status.value == 'Inactive')
                            {
                                swal('El material no puede ser despachado por que esta inactivo', '', "error");
                                
                                return true;
                            }                        
                        //console.log('cantidad enviada: '+quantity.value);
                        
                        var cant = document.getElementById("form1").elements["quantity[]"];
                        //console.log('cantidad permitda: '+cant.value);
                        
                            if(parseFloat(quantity.value) > parseFloat(cant.value))
                            {
                                swal('la cantidad a entrega no puede ser mayor a: '+cant.value, 
                                    '', 
                                    "error");
                                
                                return true;
                            }
                        
                        
                        
                    }
                    var quantity_comment = document.getElementById("form1").elements["comment[]"];
                
                    if(quantity_comment.value === '')
                    {
                        data.comment = 'NULL';
                    }
                    else
                    {
                        data.comment = quantity_comment.value;
                    }                                
                    
                }
            }
            else
            {
                //var datos = [];
                var items = [];          
                for (var x=0; x < checkboxes.length; x++) 
                {
                    
                    if (checkboxes[x].checked) 
                    {
                        cont = cont + 1;
                        
                        data[x] = new Object();
                        
                        data[x].material_id = checkboxes[x].value;
                        var status = document.getElementById("form1").elements["item_status[]"];
                        var name_material = document.getElementById("form1").elements["name_material[]"];
                        for (var z = 0; z < status.length; z++) 
                        {
                            if(status[x].value == 'Inactive')
                                {
                                    //for (var index = 0; index < name_material.length; index++) {
                                        swal('El material no puede ser despachado por que esta inactivo', 
                                         'en el registro '+ (x+1)+' con nombre: '+name_material[x].value, 
                                         "error");
                                        
                                    //}
                                    
                                    
                                    return true;
                                }
                        }

                        var item_id = document.getElementById("form1").elements["item_id[]"];
                        for (var t = 0; t < item_id.length; t++) 
                        {
                            if(item_id[x].value > 0)
                            {
                                console.log(item_id[x].value);
                                items[x] = item_id[x].value;
                                data[x].item_id = item_id[x].value;
                            }
                            else{}
                            
                            //[x].item_id = ;
                            
                        }
                        
                        var quantity = document.getElementById("form1").elements["quantity_return[]"];
                        for(var i=0;i<quantity.length;i++)
                        {
                            
                            if(quantity[x].value == 0)
                            {
                                swal('la cantidad a devolver debe ser mayor a: ' +quantity[x].value,
                                    'en el registro '+ (x+1)+' con nombre: '+name_material[x].value,
                                    "error");
                                
                                return true;
                            }
                            else
                            {
                               // console.log('cantidad enviada: '+quantity[x].value);
                                data[x].quantity = quantity[x].value;
                                
                                var cant = document.getElementById("form1").elements["quantity[]"];
                                
                                for(var n=0;n< cant.length;n++)
                                {                                    
                                    if(parseFloat(quantity[x].value) > parseFloat(cant[x].value))
                                    {
                                        swal('la cantidad a entrega no puede ser mayor a: '+cant[x].value, 
                                        'en el registro '+ (x+1)+' con nombre: '+name_material[x].value,
                                        "error");
                                        
                                        return true;
                                    }
                                }
                                
                            }                                
                        }
                        var quantity_comment = document.getElementById("form1").elements["comment[]"];
                        for(var n=0;n<quantity_comment.length;n++)
                        {
                            if(quantity_comment[n].value === '')
                            {
                                data[x].comment = 'NULL';
                            }
                            else
                            {
                                data[x].comment = quantity_comment[x].value;
                            }                                
                        }                            
                    }               
                }
                //console.log('ITEMS '+items );
            }
            if(cont === 0)
            {
                swal('Atencion!','Debe despachar al menos un material para poder continuar!', "info");
                return true;
            }
            var employee = document.getElementById("form1").elements["employee"].value;
            if( employee == 0)
            {
                swal('Atencion!','Debe seleccionar un vendedor para poder continuar!', "info");
                return true;
            }

            
            //data.employee = employee;
            var work_order = document.getElementById("form1").elements["work_oreder_id"].value;
            //data.work_order_id = work_order;
            console.log(data);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: $("#form1").attr('action'),
                type: $("#form1").attr('method'),
                data: {
                        datos : data, 
                        _token : _token,
                        employee : employee, 
                        work_order : work_order, 
                        description : description,
                        items : items 
                    },
                
                success: function(result){
                    console.log('ok'+result);                    
                    if (result == 'dispatch_ok')
                    {
                        location.href = '/devolucion-ot';
                        swal('Info','Despacho de materiales realizado con exito!','success');
                    }
                    else
                    {
                        //console.log(typeof(result.toString()));
                        var response = result.toString().split(",");
                        if(response[0] == 'stock')
                        {
                            swal('Esta cantidad no puede ser entregada en su stock solo hay disponible : '+response[1],
                                 'del material '+ response[3], "error");
                        }
                    }
                    
                },
                error: function(){
                    console.log('Error');
                }
            });                
    });            
});