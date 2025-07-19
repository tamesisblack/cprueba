<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@extends('layouts.admin')
@section('title', 'Registro de Ventas')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Datos Venta</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="customer">Cliente (*)</label>
                            <select name="customer" id="customer" class="form-control">
                                <option value="">seleccionar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="impuesto">Impuesto (*)</label>
                            <select name="tax" id="tax" class="form-control">
                                <option value="">seleccionar</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_comprobante">Tipo Comprobante (*)</label>
                            <select id="tipo_comprobante" name="tipo_comprobante" class="form-control">
                                <option data-id='' value="">seleccionar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="currency">Serie (*)</label>
                            <input type="text" name="serie" id="serie" class="form-control" placeholder="Serie 000x" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="currency">Núm. Comprobante (*)</label>
                            <input type="text" name="voucher_number" id="voucher_number" class="form-control" placeholder="Núm 000x" required>
                        </div>
                    </div>
                    <div class="col-md-3">
					 <div class="form-group">
						{!! Form::label('currency','Moneda') !!}
						{!! Form::select('currency', [], null, ['class' => 'form-control']) !!}
					</div>	
					
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Detalle Venta </h3>
            </div>
            <div class="box-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cliente">Articulo (*)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" min="0" step="any" pattern="\d*" name="codigo_articulo" id="codigo_articulo" placeholder="Escanea el código de barras" class="form-control" autofocus>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat btn-open-search"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                                <hr>
                                <blockquote class="result_search hidden">
                                    <h1>No existe el articulo!</h1>
                                </blockquote>
                                <blockquote class="detail_item hidden quote-secondary">
                                    <p class="hidden inv_item_id"></p>
                                    <p><i class="fa fa-align-justify"></i> <span class="item_name"></span></p>
                                    <p><i class="fa fa-barcode"></i> <span class="item_code_ean"></span></p>
                                    <p><i class="fa fa-sort-numeric-asc"></i> <span class="item_stock"></span></p>
                                </blockquote>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="price" class="text_red">UDM <span class="text-danger">(*)</span></label>
                                <select name="udm" id="udm" class="form-control input-lg"></select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="price" class="text_red">Precio <span class="text-danger">(*)</span></label>
                                <input id="price" name="price" type="number" min="0" step="any" class="form-control input-lg" placeholder="0.00" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Descuento</label>
                                <input id="discount" name="discount" min="0" type="number" class="form-control input-lg" placeholder="0" value="0">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="quantity" class="text-red">Cantidad <span class="text-danger">(*)</span></label>
                                <div class="input-group input-group-lg">
                                    <input id="quantity" name="quantity" min="0" step="any" pattern="\d*" type="number" class="form-control" placeholder="0" value="0">
                                    <span class="input-group-btn">
                                        <button id="btnAddItem" name="btnAddItem" class="btn btn-success form-control"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="table-responsive col-md-12">
                        <table id="detail" class="table table-bordered table-striped table-lg">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Acción</th>
                                    <th class="text-center hidden">Codigo Barras</th>
                                    <th class="text-center">Articulo</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">UDM</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Descuento</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center">No hay articulos agregados</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer pull-right">
            <input type="hidden" name="grandTotal" id="grandTotal" value="0">
            <a class="btn btn-danger" href="{{url('sales')}}">
                Cancelar
            </a>
            <button id="btn-payment" name="btn-payment" type="button" class="btn btn-success btn-lg float-right hidden">
                PAGAR
                 <span class="btn-pay">0.00</span></button>
        </div>
    </div>

    {{-- Modal Search items --}}
    <div class="modal fade" id="modal-items">
        <div class="modal-dialog modal-lg" style="width:1250px;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Selecciona una o varios articulos</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group input-group-lg">
                                <input id="items" name="items" type="text" class="form-control input-lg" placeholder="Texto a buscar" value="" autofocus />
                                <span class="input-group-btn">
                                    <button id="btn-search-items" name="btn-search-items" type="button" class="btn btn-info btn-flat btn-search-items"><i class="fa fa-search "></i>
                                        Buscar</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <table id="table-item-search" class="table table-bordered table-striped table-sm">
                            <thead class=" bg-primary">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Stock</th>
                                    <th>UDM</th>
                                    <th>Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary btn-lg" onclick="closeModal()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    {{-- Modal Pay --}}
    <div class="modal fade" id="modal-payment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" onclick="closeModalPayment()">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">CERRAR VENTA</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="voucher_type" class="col-md-3 control-label">Tipo Comprobante</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="voucher_type" name="voucher_type" placeholder="Tipo Comprobante" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="delivery_type" class="col-md-3 control-label">Tipo Entrega</label>
                                <div class="col-md-9">
                                    <div class="clearfix"></div>
                                    <p></p>
                                    <p>
                                        <label class="pull-left">
                                            <input type="radio" name="delivery_type" class="flat-red delivery_type" value="I"> Entrega Inmediata
                                        </label>
                                        <label class="pull-right">
                                            <input type="radio" name="delivery_type" class="flat-red delivery_type" value="P" checked> Por
                                            Despachar
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="payment_method" class="col-md-3 control-label">Metodo Pago</label>
                                <div class="col-md-9">
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option data-reference="0" value="0" disabled>Selecciona un metodo de pago
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group paymentReference hidden">
                                <label for="payment_reference" class="col-md-3 control-label">Referencia</label>
                                <div class="col-md-9">
                                    <input type="text" name="payment_reference" id="payment_reference" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount_payable" class="col-md-3 control-label">Monto a Pagar</label>
                                <div class="col-md-9">
                                    <input type="text" name="amount_payable" id="amount_payable" class="form-control input-lg" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cash_paid" class="col-md-3 control-label">Efectivo Pagado</label>
                                <div class="col-md-9">
                                    <input onchange="cash_return(this.value)" onkeyup="cash_return(this.value)" type="text" name="cash_paid" id="cash_paid" class="form-control input-lg text-bold" value="0.00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cash_returned" class="col-md-3 control-label">Vuelto</label>
                                <div class="col-md-9">
                                    <input type="text" name="cash_returned" id="cash_returned" class="form-control input-lg text-bold" value="0.00" readonly>
                                </div>
                            </div>
                            <div class="form-group remaining_cash hidden">
                                <label for="remaining_cash" class="col-md-3 control-label">Restante</label>
                                <div class="col-md-9">
                                    <input type="text" id="remaining_cash" class="form-control input-lg text-bold" value="0.00" readonly>
                                    {{-- <div class="input-group input-group-lg">
                                        
                                        <span class="input-group-btn">
                                            <button title="Forma de pago" id="btn-search-items" name="btn-search-items" type="button"
                                                class="btn btn-info btn-xs btn-flat btn-search-items"><i class="fa fa-plus"></i></button>
                                        </span>                                       
                                    </div> --}}
                                    <p class="help-block pull-right"><button id="btnAddPaymentMethod" name="btnAddPaymentMethod" type="button" class="btn btn-block btn-warning"><i class="fa fa-plus"></i> Agregar forma
                                            de pago</button></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group payTable">
                                <table id="pay_table" class="table table-bordered table-striped table-sm hidden">
                                    <thead class="bg-info">
                                        <tr>
                                            <th></th>
                                            <th>Metodo</th>
                                            <th>Monto</th>
                                            <th>Referencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}

                    <button type="button" class="btn btn-secondary btn-lg pull-left" onclick="closeModalPayment()">CANCELAR</button>
                    <button id="btnConfirm" name="btnConfirm" type="button" class="btn btn-success btn-lg pull-right">CONFIRMAR PAGO <i class="fa fa-check"></i></button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- -->
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {

        //Every time the page is refreshed remove the item from the local storage
        localStorage.clear();
        let _itemsDetail = [];
        let _tax = $('#tax').val(); //parseFloat($('#tax').val()); //18;
        const _validateStock = '{{$validateStock}}';
        let _label_tax_code = '{{$site->label_tax_code}}';
        let _item_id = 0;
        let _item_name = "";
        let _item_quantity = 0;
        let _item_price = 0;
        let _item_stock = 0;
        let _item_category = 0;
        let _additional_reference = 0;
        let _item_uom_code = '';
        let _currency_ = $('#currency').val();
        let _exchange_rate = 1;
        let _data_uom_ = [];
        //let _dataUom = JSON.parse('{!!$uom!!}');
        //console.log(_dataUom);

        exhange_rate(_currency_).then(response => {
            if (response.status === 1) {
                _exchange_rate = parseFloat(response.data.exchange_rate);
                if (localStorage.hasOwnProperty('itemsDetail')) {
                    $('#btn-payment').removeClass('hidden');
                }

            } else {
                Swal.fire({
                    title: response.message
                    , icon: 'error'
                });
                $('#btn-payment').addClass('hidden');
            }
        }).catch(error => {
            console.log(error);
        });

        $('#currency').on('change', function(e) {
            e.preventDefault();
            _label_tax_code = ($(this).val() === 'USD') ? '$' : '{{$site->label_tax_code}}'

            exhange_rate($(this).val()).then(response => {
                if (response.status === 0) {
                    Swal.fire({
                        title: response.message
                        , icon: 'error'
                    });
                    $('#btn-payment').addClass('hidden');
                } else {

                    let _newItemsDetail = [];
                    _itemsDetail = [];
                    let _total = 0;
                    let _taxTotal = 0;
                    let _subtotal = 0;
                    _exchange_rate = parseFloat(response.data.exchange_rate);
                    if (localStorage.hasOwnProperty("itemsDetail")) {
                        _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
                        $('#btn-payment').removeClass('hidden')
                    } else {
                        _itemsDetail = [];
                    }

                    $.each(_itemsDetail, function(idx, v) {
                        v.exchange_rate = _exchange_rate;
                        v.subtotal = (v.price * v.quantity) * v.exchange_rate;
                        $(`.subtotal${v.id}`).html(formatCurrency(parseFloat(((v.price * v.quantity) * v.exchange_rate))));
                        _newItemsDetail.push(v);
                    });

                    $.each(_newItemsDetail, function(idx, v) {
                        _total += (((v.price * v.quantity) - v.discount) * v.exchange_rate);
                    });
                    _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
                    _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;
                    $(`.totalParcial`).html(formatCurrency(parseFloat(_subtotal)));
                    $(`.taxTotal`).html(formatCurrency(parseFloat(_taxTotal)));
                    $(`.grandTotal`).html(_label_tax_code + ' ' + formatCurrency(parseFloat(_total)));
                    $('.btn-pay').html(formatCurrency(parseFloat(_total)));
                    $('#amount_payable').val(formatCurrency(parseFloat(_total)));
                    $('#cash_paid').val(formatCurrency(parseFloat(_total)));
                    $('#grandTotal').val(_total);
                    if (localStorage.hasOwnProperty("itemsDetail")) {
                        localStorage.removeItem('itemsDetail');
                    }
                    localStorage.setItem('itemsDetail', JSON.stringify(_newItemsDetail));
                }
            }).catch(error => {
                console.log(error);
            });
        })

        $('#tax').on('change', function(e) {
            e.preventDefault();
            _tax = $(this).val();
            let _newItemsDetail = [];
            if (localStorage.hasOwnProperty("itemsDetail")) {
                _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
            } else {
                _itemsDetail = [];
            }

            $.each(_itemsDetail, function(idx, v) {
                v.tax = _tax;
                _newItemsDetail.push(v);
            });

            let _total = 0;
            let _taxTotal = 0;
            let _subtotal = 0;
            $.each(_newItemsDetail, function(idx, v) {
                _total += (((v.price * v.quantity) - v.discount) * v.exchange_rate);
            });
            _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
            _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;
            $(`.totalParcial`).html(formatCurrency(parseFloat(_subtotal)));
            $(`.taxTotal`).html(formatCurrency(parseFloat(_taxTotal)));
            $(`.grandTotal`).html(_label_tax_code + ' ' + formatCurrency(parseFloat(_total)));
            $('.btn-pay').html(formatCurrency(parseFloat(_total)));
            $('#amount_payable').val(formatCurrency(parseFloat(_total)));
            $('#cash_paid').val(formatCurrency(parseFloat(_total)));
            $('#grandTotal').val(_total);
            if (localStorage.hasOwnProperty("itemsDetail")) {
                localStorage.removeItem('itemsDetail');
            }

            localStorage.setItem('itemsDetail', JSON.stringify(_newItemsDetail));
        })

        //Open modal for search
        $('.btn-open-search').on('click', function(e) {
            e.preventDefault();
            $('#modal-items').modal({
                backdrop: 'static'
            });
            _clearItems();

        });

        //set focus when opening modal
        $('#modal-items').on('shown.bs.modal', function() {
            $('#items').focus().select();
        });

        //click event when entering the input
        $('#items').on('keyup', function(e) {
            if (e.keyCode === 13) {
                $('.btn-search-items').click();
            }
        });

        //Item search result
        $('.btn-search-items').on('click', function(e) {
            e.preventDefault();
            let _text = $('#items').val();
            _search_items(_text, 'modal').then(response => {
                if (response.status === 1) {
                    $('#table-item-search tbody').empty();

                    $.each(response.data, function(idx, v) {
                        //console.log(v)
                        let _populate_select = '';
                        $.each(v.uom, function(idxu, vu) {
                            _populate_select += `<option data-uomprimary='${v.primary_uom_code}' data-itemid='${v.inv_item_id}' data-uom='${vu.uom_code}' ${(vu.uom_code == v.primary_uom_code) ? 'selected': ''} data-description='${vu.description}' value='${vu.iduom}'>${vu.uom_code}</option>`
                        });

                        $('#table-item-search tbody').append(`
                            <tr>                                    
                                <td>${v.inv_item_id}</td>
                                <td>${v.nombre_item}</td>
                                <td>${formatCurrency(v.stock_item)}</td>
                                <td><select id='item_uom${v.inv_item_id}' name='item_uom${v.inv_item_id}' class='form-control item_uom'>${_populate_select}</select></td>
                                <td>${formatCurrency(v.price)}</td>                                
                                <td><input onchange='validateInput(${v.inv_item_id})' onkeyup='validateInput(${v.inv_item_id})' id='quantity_add_${v.inv_item_id}' name='quantity_add_${v.inv_item_id}' type='number' min="0"  pattern="^\d*(\.\d{0,2})?$"  class='form-control' value='1'></td>
                                <td>
                                    <button data-uom='${JSON.stringify(v.uom)}' data-uomcode='${v.primary_uom_code}' data-category='${v.idcategoria}' data-ean='${v.ean}' data-name='${v.nombre_item}' data-price='${v.price}' data-stock='${v.stock_item}' data-id='${v.inv_item_id}' type='button' class='btn btn-success btn-xs form-control btnAddItemModal'>
                                        <i class='fa fa-2x fa-plus'></i>
                                    </button>				
                                </td>
                            </tr>
                        `);
                    });



                }
                //console.log(response)
            }).catch(error => {
                message('Error encontrado', error, 'error');
            });
        });

        //add row to detail and remove row from table
        $("#table-item-search").on("click", "button.btn", function(e) {
            let _id = parseInt($(this).data('id'));
            let _price = parseFloat($(this).data('price'));
            let _stock = parseFloat($(this).data('stock'));
            let _category = $(this).data('category');
            let _primary_uom_code = $(this).data('uomcode');
            let input = document.getElementById('quantity_add_' + _id);
            let _name = $(this).data('name');
            let _ean = (!isEmpty($(this).data('ean'))) ? $(this).data('ean') : _id;
            //let _uom = $(this).data('uom');
            _data_uom_ = $(this).data('uom');
            //console.log(_uom)
            //console.log(_data_uom_)
            if (_validateStock) {
                if (parseFloat(input.value) > _stock) {
                    message('Stock', `La cantidad supera al stock actual : ${_stock}`, 'warning');
                    return;
                }
            }
            let _options = document.getElementById('item_uom' + _id)
            _primary_uom_code = _options.options[_options.selectedIndex].dataset.uom;

            _item_id = _id;
            _item_category = _category;
            _item_uom_code = _primary_uom_code
            $('.inv_item_id').html(_id);
            $('.item_name').html(_name);
            _item_name = _name;
            $('.item_code_ean').html(_ean);
            $('.item_stock').html(_stock);
            $('#price').val(_price);
            $('#quantity').val(input.value);
            _item_quantity = input.value;
            _item_price = _price;
            _item_stock = _stock;
            $('#btnAddItem').click();
            $(this).parent().parent().remove();

            _clearItems();
        });

        //Change uom for calculate quantity
        $('#table-item-search tbody').on('change', 'select', function(e) {
            let uom = $(this).children("option:selected").data('uom');
            let item = $(this).children("option:selected").data('itemid');
            let uom_primary = $(this).children("option:selected").data('uomprimary');
            let input = document.getElementById('quantity_add_' + item);
            input.value = 1;
            let quantity = 1;
            convertionRate(uom, uom_primary).then(response => {
                let _convertion_rate = parseFloat(response.convertion_rate);
                quantity = parseFloat(input.value * _convertion_rate);
                input.value = quantity;

            }).catch(error => {
                console.log(error)
            });
        });


        /******************Detail items ***********************/
        //Key enter input 
        $('#codigo_articulo').on('keyup', function(e) {
            if (e.keyCode === 13 && $(this).val() != "") {
                let _codigo = $(this).val();
                _search_items(_codigo).then(response => {
                    if (response.status === 1) {
                        _item_id = parseInt(response.data[0].inv_item_id);
                        $('.inv_item_id').html(response.data[0].inv_item_id);
                        $('.detail_item').removeClass('hidden');
                        $('.result_search').addClass('hidden');
                        $('.item_name').html(response.data[0].nombre_item);
                        _item_name = response.data[0].nombre_item;
                        $('.item_code_ean').html(_codigo);
                        $('.item_stock').html(response.data[0].stock_item);
                        $('#price').val(response.data[0].price);
                        $('#quantity').val(1).focus().select();
                        _item_quantity = 1; //parseFloat($('#quantity').val());
                        _item_price = response.data[0].price;
                        _item_stock = response.data[0].stock_item
                        _item_category = response.data[0].idcategoria
                        _item_uom_code = response.data[0].primary_uom_code;
                        $.each(response.data[0].uom, function(idx, v) {
                            $('#udm').append(`
                                <option ${(v.uom_code === _item_uom_code) ? 'selected': ''} value='${v.iduom}'>${v.uom_code}</option>
                            `);
                        });

                    } else {
                        $(this).select();
                        $('.result_search').removeClass('hidden');
                    }

                }).catch(error => message('error', error, 'error'))
            } else if (e.keyCode === 8 || e.keyCode === 48) {
                _clearItems();
            }
        });

        $('#quantity').on('keyup', function(e) {
            if (e.keyCode === 13) {
                $('#btnAddItem').click();
            }
        });

        $('#btnAddItem').on('click', function(e) {
            e.preventDefault();
            _item_quantity = $('#quantity').val();
            //Validate null or empty inputs
            if (_item_id == 0 || _item_quantity == 0 || _item_price == 0) {
                message('Campos Requeridos', `(*) Campos requeridos | cantidad o precio no puede ser valor 0`, 'error', 4000);
                $('#codigo_articulo').focus().select();
                return;
            }

            if (_validateStock) {
                if (_item_quantity > _item_stock) {
                    message('Stock', `La cantidad supera al stock actual : ${_item_stock}`, 'warning');
                    return;
                }
            }

            if (localStorage.hasOwnProperty("itemsDetail")) {
                _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
                $('#btn-payment').removeClass('hidden')
            } else {
                _itemsDetail = [];
            }

            //Validate stock
            if (validateStock()) {
                return;
            }

            //remove validation to restrict add more than 2 times the same product 
            // if (finded) {
            //     message('Articulo Agregado', `El articulo ${_item_name}, actualmente se encuentra en el detalle`, 'warning', 4000);
            //     $('#codigo_articulo').focus().select();
            //     return;
            // }


            let _id = $('.inv_item_id').text();
            let _codeEan = $('#codigo_articulo').val();
            let _itemName = $('.item_name').text();
            let _itemPrice = parseFloat($('#price').val());
            let _itemDiscount = parseFloat($('#discount').val());
            let _itemQuantity = parseFloat($('#quantity').val());
            let _itemSubtotal = parseFloat((((_itemPrice * _itemQuantity) - _itemDiscount) * _exchange_rate)); //Row detail
            let _itemStock = parseFloat($('.item_stock').text());
            let _subtotal = 0;
            let _taxTotal = 0;
            let _total = 0;

            //Validate discount
            if (parseFloat(_itemDiscount) > (parseFloat(_itemSubtotal))) {
                message('Descuento!', `El descuento no puede ser mayor al total : ${_itemSubtotal}`, 'warning');
                $('#discount').focus().select();
                return;
            }

            if (_itemsDetail.length > 0) {

                //validate the new quantity to be added to determine that it does not exceed the stock
                let finded = false;
                let _newQuantity = _itemQuantity;
                $.each(_itemsDetail, function(idx, v) {
                    if (parseInt(v.id) === parseInt(_item_id)) {
                        finded = true;
                        //I add the new quantity to the existing quantity
                        _newQuantity += v.quantity;
                        return false;
                    }
                });

                //If the record exists in the object then proceed to validate stock
                if (finded) {

                    //If stock validation is enabled
                    if (_validateStock) {

                        //if the new quantity exceeds the stock
                        if (_newQuantity > _item_stock) {
                            message('Stock', `La cantidad supera al stock actual : ${_item_stock}`, 'warning');
                            return;
                        } else {
                            $("#detail tbody").empty();
                        }
                    } else {
                        $("#detail tbody").empty();
                    }
                } else {
                    $("#detail tbody").empty();
                }

                //Remove item to object
                $.each(_itemsDetail, function(idx, v) {
                    if (parseInt(v.id) === parseInt(_item_id)) {
                        _itemsDetail.splice(idx, 1);
                        _itemQuantity += v.quantity;
                        _itemSubtotal = (((_itemPrice * _itemQuantity) - _itemDiscount) * _exchange_rate);
                        return false;
                    }
                });

                //Add items to the object
                _itemsDetail.push({
                    id: _id
                    , ean: _codeEan
                    , name: _itemName
                    , price: _itemPrice
                    , quantity: _itemQuantity
                    , subtotal: _itemSubtotal
                    , stock: _itemStock
                    , discount: _itemDiscount
                    , tax: _tax
                    , category: _item_category
                    , uom: _item_uom_code
                    , exchange_rate: _exchange_rate
                    , data_uom: _data_uom_
                });

                //calculate the total again with the new record added
                _total = calculateTotal();
                _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
                _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;


                // let _options_uom = ``;
                // $.each(_data_uom_, function(idx, v) {
                //     _options_uom += `<option ${(_item_uom_code === v.uom_code) ? 'selected' : ''} data-description='${v.description}' value='${v.iduom}'>${v.uom_code}</option>`
                // });


                //populate the table with the object values
                
                $.each(_itemsDetail, function(idx, v) {
                    console.log(v)
                    let _options_uom = ``;
                    $.each(v.data_uom, function (idxu, vu) {
                        _options_uom += `<option ${(v.uom === vu.uom_code) ? 'selected' : ''} data-description='${vu.description}' value='${vu.iduom}'>${vu.uom_code}</option>`
                    });
                    //console.log(_options_uom)
                    $("#detail tbody").append(`<tr>
                        <td class="text-center">
                            <button data-id='${v.id}' type="button" class="btn btn-danger btn-xs removeItem">
                                <i class="fa fa-2x fa-minus-circle"></i>
                            </button>
                        </td>
                        <td class='hidden'>${v.ean}</td>
                        <td>${v.name}</td>
                        <td class='text-center'>${formatCurrency(v.price)}</td>
                        <td class='text-center'>${v.stock}</td>
                        <td><select class='form-control' id='uom_primary${v.id}' name='uom_primary${v.id}'>${_options_uom}</select></td>
                        <td><input data-product='${v.name}' data-uomcode='${v.uom}' data-category='${v.category}' data-tax='${v.tax}' data-price='${v.price}' data-discount='${v.discount}' data-stock='${v.stock}'  min="0" step="any" pattern="^\d*(\.\d{0,2})?$" onkeyup='validateStock(${v.id})' type='number' id='itemQuantity${v.id}' name='itemQuantity${v.id}' value='${v.quantity.toFixed(2)}' class='form-control'></td>
                        <td class='text-center'><input type='number' value='${v.discount}' onkeyup="validaDescuento(${v.id}, this)" class='form-control' min="0" step="any" pattern="^\d*(\.\d{0,2})?$"/></td>
                        <td class='text-right subtotal${v.id}'>${formatCurrency(v.subtotal)}</td>
                    </tr>`);
                });

                //set the new values ​​of the subtotals in the footer of the table
                $("#detail tbody").append(`
                    <tr style="background-color: #CEECF5">
                        <td colspan="7" class="text-right"><strong>Subtotal</strong></td>														
                        <td class="text-right totalParcial">${formatCurrency(_subtotal)}</td>
                    </tr>
                    <tr style="background-color: #CEECF5">
                        <td colspan="7" class="text-right"><strong>Impuesto</strong></td>											
                        <td class="text-right taxTotal">${formatCurrency(_taxTotal)}</td>
                    </tr>
                    <tr style="background-color: #CEECF5">
                        <td colspan="7" class="text-right"><h3><strong>Total</strong></h3></td>														
                        <td class="text-right"><h3 class='grandTotal'>${_label_tax_code} ${formatCurrency(_total)}</h3></td>
                    </tr>
                `);

                //Clear inputs
                _clearItems();
                _item_id = 0;
                _item_name = "";
                $('.btn-pay').html(formatCurrency(parseFloat(_total)));
                $('#amount_payable').val(formatCurrency(parseFloat(_total)));
                $('#cash_paid').val(formatCurrency(parseFloat(_total)));
                $('#grandTotal').val(_total);
            } else {

                $("#detail tbody").empty();
                //Add items to the object
                _itemsDetail.push({
                    id: _id
                    , ean: _codeEan
                    , name: _itemName
                    , price: _itemPrice
                    , quantity: _itemQuantity
                    , subtotal: _itemSubtotal
                    , stock: _itemStock
                    , discount: _itemDiscount
                    , tax: _tax
                    , category: _item_category
                    , uom: _item_uom_code
                    , exchange_rate: _exchange_rate
                    , data_uom: _data_uom_
                });

                _total = calculateTotal();
                _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
                _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;

                let _options_uom = ``;
                $.each(_data_uom_, function(idx, v) {
                    _options_uom += `<option ${(_item_uom_code === v.uom_code) ? 'selected' : ''} data-description='${v.description}' value='${v.iduom}'>${v.uom_code}</option>`
                });

                let _items = `<tr>
                    <td class="text-center">
                        <button data-id='${_id}' type="button" class="btn btn-danger btn-xs removeItem">
                            <i class="fa fa-2x fa-minus-circle"></i>
                        </button>
                    </td>
                    <td class='hidden'>${_codeEan}</td>
                    <td>${_itemName}</td>
                    <td class='text-center'>${formatCurrency(_itemPrice)}</td>
                    <td class='text-center'>${_itemStock}</td>
                    <td><select class='form-control' id='uom_primary${_id}' name='uom_primary${_id}'>${_options_uom}</select></td>
                    <td><input data-product='${_itemName}' data-uomcode='${_item_uom_code}' data-category='${_item_category}' data-tax='${_tax}' data-price='${_itemPrice}' data-discount='${_itemDiscount}' data-stock='${_itemStock}'  min="0" step="any" pattern="^\d*(\.\d{0,2})?$"0. onkeyup='validateStock(${_id})' type='number' id='itemQuantity${_id}' name='itemQuantity${_id}' value='${_itemQuantity.toFixed(2)}' class='form-control'></td>
                    <td class='text-center'><input type='number' value='${_itemDiscount}' onkeyup="validaDescuento(${_id}, this)" class='form-control' min="0" step="any" pattern="^\d*(\.\d{0,2})?$"/></td>
                    <td class='text-right subtotal${_id}'>${formatCurrency(_itemSubtotal)}</td>
                </tr>
                <tr style="background-color: #CEECF5">
                    <td colspan="7" class="text-right"><strong>Subtotal</strong></td>														
                    <td class="text-right totalParcial">${formatCurrency(_subtotal)}</td>
                </tr>
                <tr style="background-color: #CEECF5">
                    <td colspan="7" class="text-right"><strong>Impuesto</strong></td>											
                    <td class="text-right taxTotal">${formatCurrency(_taxTotal)}</td>
                </tr>
                <tr style="background-color: #CEECF5">
                    <td colspan="7" class="text-right"><h3><strong>Total</strong></h3></td>														
                    <td class="text-right"><h3 class='grandTotal'>${_label_tax_code} ${formatCurrency(_total)}</h3></td>
                </tr>
                `;
                //console.log(_itemsDetail)
                //Clear items search 
                _clearItems();
                _item_id = 0;
                _item_name = "";
                $("#detail tbody").append(_items);
                $('.btn-pay').html(formatCurrency(parseFloat(_total)));
                $('#amount_payable').val(formatCurrency(parseFloat(_total)));
                $('#cash_paid').val(formatCurrency(parseFloat(_total)));
                $('#grandTotal').val(_total);
                $('#btn-payment').removeClass('hidden');

            }

            console.log(_itemsDetail)

            //Remove itemsDetail
            if (localStorage.hasOwnProperty('itemsDetail')) {
                localStorage.removeItem('itemsDetail');
            }

            //Create itemsDetail
            localStorage.setItem('itemsDetail', JSON.stringify(_itemsDetail));
        });

        //Remove item detail
        $("#detail tbody").on("click", "button.btn", function(e) {
            let _id = $(this).data('id');
            let _itemsDetail = []
            let _newItems = [];
            let _newTotal = 0;
            let _newSubtotal = 0;
            let _newTaxTotal = 0;

            _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
            //Remove item            
            $(this).parent().parent().remove();
            $.each(_itemsDetail, function(idx, v) {
                if (parseInt(v.id) === parseInt(_id)) {
                    _itemsDetail.splice(idx, 1);
                    return false;
                }
            });

            //Set new values
            $.each(_itemsDetail, function(idx, v) {
                _newItems.push(v);
            })

            // console.log(_newItems)

            //New Total value            
            $.each(_newItems, function(idx, v) {
                _newTotal += (((v.price * v.quantity) - v.discount) * v.exchange_rate);
            });

            _newTaxTotal = (parseFloat(_tax) * 1 * parseFloat(_newTotal)) / 100;
            _newSubtotal = (((parseFloat(_newTotal) - parseFloat(_newTaxTotal)) * 1) + 0) * 1;

            $(`.totalParcial`).html(formatCurrency(parseFloat(_newSubtotal)));
            $(`.taxTotal`).html(formatCurrency(parseFloat(_newTaxTotal)));
            $(`.grandTotal`).html(_label_tax_code + formatCurrency(parseFloat(_newTotal)));
            $('#cash_paid').val(formatCurrency(parseFloat(_newTotal)));
            $('#grandTotal').val(_newTotal);
            $('#amount_payable').val(formatCurrency(parseFloat(_newTotal)));
            $('.btn-pay').html(formatCurrency(parseFloat(_newTotal)));

            //Remove itemsDetail
            localStorage.removeItem('itemsDetail');

            //Create itemsDetail
            if (_newItems.length > 0) {
                localStorage.setItem('itemsDetail', JSON.stringify(_newItems));
                $('#btn-payment').removeClass('hidden');
            } else {
                $("#detail tbody").empty().append(`
                <tr>
                    <td colspan="7" class="text-center">No hay articulos agregados</td>
                </tr>
                `);
                $('#btn-payment').addClass('hidden');
            }
        })

        /******************PAYMENT SECTION ************/
        $('#btn-payment').on('click', function(e) {
            e.preventDefault();

            let _serie = $('#serie').val();
            let _voucher_num = $('#voucher_number').val();
            if (_serie === '' || _voucher_num === '') {
                message('* Campos requeridos', 'Debe ingresar la serie y número de comprobante', 'error');
                $('#serie').select().focus();
                return;
            }
            $('#modal-payment').modal({
                backdrop: 'static'
            });
            $('#voucher_type').val($("#tipo_comprobante option:selected").text());
            $('#remaining_cash').val(0.00);
        });

        //set focus when opening modal
        $('#modal-payment').on('shown.bs.modal', function() {
            $('#cash_paid').focus().select();
        });

        //Select payment method
        $('#payment_method').on('change', function(e) {
            let _id = $(this).val();
            let _additional = $(this).find(':selected').data('reference')
            if (_additional) {
                _additional_reference = 1;
                $('.paymentReference').removeClass('hidden');
                $('#payment_reference').focus();
            } else {
                _additional_reference = 0;
                $('.paymentReference').addClass('hidden');
            }
        });

        $('#btnAddPaymentMethod').on('click', function(e) {
            e.preventDefault();

            let _originalPayment = parseFloat($('#grandTotal').val());
            let _remaining = parseFloat($('#remaining_cash').val())
            let _payments = [];
            let _table = ``;
            let _count = 1;
            let _paid = parseFloat($('#cash_paid').val());
            let _reference = $('#payment_reference').val();
            let _method_text = $("#payment_method option:selected").text().trim();
            let _method_id = parseInt($("#payment_method").val());
            let _newBalance = 0;

            if (isNaN(_method_id) || _method_id == 0) {
                message('Metodo Pago', 'Debe agregar un metodo de pago', 'error');
                return;
            }

            if (_additional_reference && _reference == '') {
                message('Referencia', 'Agrega una referencia para el pago', 'error');
                return;
            }

            //Show table
            $('#pay_table').removeClass('hidden');

            if (localStorage.hasOwnProperty('payments')) {
                _payments = JSON.parse(localStorage.getItem('payments'));
                _count += _payments.length;
                _newBalance = Math.min.apply(Math, _payments.map(a => a.balance));
            }

            if (_payments.length > 0) {
                let finded = false;
                $.each(_payments, function(idx, v) {
                    if (parseInt(v.method_id) === parseInt(_method_id)) {
                        finded = true;
                        return false;
                    }
                });
                if (finded) {
                    message('Metodo de Pago', 'Actualmente se ha efectuado un pago en: ' + _method_text + ' selecciona otra!', 'warning', 3500)
                    return;
                } else {

                    _payments.push({
                        id: _count
                        , method_id: _method_id
                        , method: _method_text
                        , amount: _paid
                        , reference: _reference
                        , total: _newBalance
                        , balance: (_newBalance - _paid)
                    });

                    _table = `
                        <tr>
                            <td>
                                <button data-amount='${_paid}' data-id='${_count}' type='button' class='btn btn-danger btn-xs btnRemovePayment'>
                                    <i class='fa fa-trash'></i>
                                </button>				
                            </td>
                            <td>${_method_text}</td>
                            <td>${formatCurrency(_paid)}</td>
                            <td>${_reference}</td>
                        </tr>
                    `;

                    $('#pay_table tbody').append(_table);

                    _newBalance = (_newBalance - _paid);
                    $('#amount_payable').val(formatCurrency(_newBalance));
                    $('#cash_paid').val(formatCurrency(_newBalance));
                    $('#cash_paid').focus().select();
                    $('#cash_returned').val(0.00);
                    $('#remaining_cash').val(0.00);
                    $('.remaining_cash').addClass('hidden');
                    $('#btnConfirm').removeClass('hidden');
                    //console.log(_payments)
                    _count++;
                    localStorage.removeItem('payments');
                    localStorage.setItem('payments', JSON.stringify(_payments));
                }
            } else {
                _payments.push({
                    id: _count
                    , method_id: _method_id
                    , method: _method_text
                    , amount: _paid
                    , reference: _reference
                    , total: _originalPayment
                    , balance: (_originalPayment - _paid)
                });

                _table = `
                    <tr>
                        <td>
                            <button data-amount='${_paid}' data-id='${_count}' type='button' class='btn btn-danger btn-xs btnRemovePayment'>
                                <i class='fa fa-trash'></i>
                            </button>				
                        </td>
                        <td>${_method_text}</td>
                        <td>${formatCurrency(_paid)}</td>
                        <td>${_reference}</td>
                    </tr>
                `;

                $('#pay_table tbody').append(_table);

                //new balance
                _newBalance = (_originalPayment - _paid);

                //assign new payment
                $('#amount_payable').val(formatCurrency(_newBalance));
                $('#cash_paid').val(formatCurrency(_newBalance));
                $('#cash_paid').focus().select();
                $('#cash_returned').val(0.00);
                $('#remaining_cash').val(0.00);
                $('.remaining_cash').addClass('hidden');
                $('#btnConfirm').removeClass('hidden');

                _count++;
                localStorage.setItem('payments', JSON.stringify(_payments));
            }
            $("#payment_method").val(0).change();
            $('#payment_reference').val('');
            //console.log(_payments)

        });

        $("#pay_table").on("click", "button.btn", function(e) {
            let _id = $(this).data('id');
            let _amount = $(this).data('amount');
            let _payments = JSON.parse(localStorage.getItem('payments'));
            let _newBalance = Math.min.apply(Math, _payments.map(a => a.balance));
            let _newPayments = [];

            $(this).parent().parent().remove();
            $.each(_payments, function(idx, v) {
                if (parseInt(v.id) === parseInt(_id)) {
                    _payments.splice(idx, 1);
                    _newBalance += _amount;
                    localStorage.removeItem('payments');
                    return false;
                }
            });

            $.each(_payments, function(idx, v) {
                _newPayments.push(v);
            });

            $('#amount_payable').val(formatCurrency(_newBalance));
            $('#cash_paid').val(formatCurrency(_newBalance));
            $('#cash_paid').focus().select();
            $('#cash_returned').val(0.00);
            $('#remaining_cash').val(0.00);
            $('.remaining_cash').addClass('hidden');
            $('#btnConfirm').removeClass('hidden');

            if (_payments.length > 0) {
                localStorage.setItem('payments', JSON.stringify(_newPayments));
            } else {
                $("#payment_method").val(1).change();
                $('#pay_table tbody').empty();
                $('#pay_table').addClass('hidden');
            }

        });

        $('#btnConfirm').on('click', function(e) {
            e.preventDefault();

            //Add payment
            $('#btnAddPaymentMethod').click();

            //proceed to close the sale
            let data = [];
            let _itemsDetail = [];
            let _itemPayments = [];
            if (localStorage.hasOwnProperty('itemsDetail')) {
                _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
            }

            if (localStorage.hasOwnProperty('payments')) {
                _itemPayments = JSON.parse(localStorage.getItem('payments'));
            }

            data.push({
                customer_id: $('#customer').val()
                , tax: $('#tax').val()
                , voucher_type: $('#tipo_comprobante').val()
                , voucher_id: $('#tipo_comprobante option:selected').data('id')
                , voucher_number: $('#voucher_number').val()
                , voucher_text: $("#tipo_comprobante option:selected").text().trim()
                , currency: $('#currency').val()
                , delivery_type: $('.delivery_type:checked').val()
                , payments: _itemPayments
                , detail: _itemsDetail
                , serie: $('#serie').val()
                , amount: $('#grandTotal').val()
                , exchange_rate: 0
            });

            _store(JSON.stringify(data)).then(response => {
                if (response.status === 1) {
                    message('Venta Generada', response.message, 'success');
                    window.open('/sales/ticket?id=' + response.data.header_id);
                    window.location.reload();
                } else {
                    closeModalPayment();
                    message('Venta ', response.message, 'error', 4500);
                }
            }).catch(error => {
                message('Error generado', error, 'error');
            });
            return false;
        });

        const _search_items = function(cod_bar, mode = 'inline') {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: '/items/search'
                    , method: 'get'
                    , dataType: 'json'
                    , data: {
                        code: cod_bar
                        , mode: mode
                    }
                , }).done(resolve).fail(reject);
            });
        }

        const calculateTotal = function() {
            let resultado = 0.0
            $.each(_itemsDetail, function(idx, v) {
                resultado += (((v.price * v.quantity) - v.discount) * v.exchange_rate)
            })
            return resultado
        }
        const _clearItems = function() {
            $('#codigo_articulo').val(null);
            $('#price').val(0);
            $('#quantity').val(0);
            $('#discount').val(0);
            $('.detail_item').addClass('hidden');
            $('.result_search').addClass('hidden');
            $('#codigo_articulo').focus();
        };
    });

    // const validateConvertionRate(e) {
    //     console.log(e.value)
    // }

    //Function
    const convertionRate = function(uom, uom_primary) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/items/convertionrate'
                , method: 'get'
                , dataType: 'json'
                , data: {
                    uom: uom
                    , uom_primary: uom_primary
                }
            , }).done(resolve).fail(reject);
        });
    }

    //Validate discount
    const validaDescuento = function(id, event) {
        let resultado = 0.0
        let _itemsDetail = [];
        let _total = 0;
        let _taxTotal = 0;
        let _subtotal = 0;
        let _newItemsDetail = [];
        let _currency_ = $('#currency').val();
        let _tax = parseFloat($('#tax').val());
        let _label_tax_code = (_currency_ === 'USD') ? '$' : '{{$site->label_tax_code}}'

        if (isEmpty(event.value)) {
            event.value = 0;
            event.select()
            //return;
        }

        if (parseInt(id) > 0) {
            if (localStorage.hasOwnProperty('itemsDetail')) {
                _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));

                $.each(_itemsDetail, function(idx, v) {
                    if (parseInt(v.id) === parseInt(id)) {
                        resultado = ((v.price * v.quantity) * v.exchange_rate)
                        return false;
                    }
                });

                //

                if (parseFloat(event.value) > parseFloat(resultado)) {
                    message('Descuento!', `El descuento no puede ser mayor al total`, 'warning');
                    event.value = 0;
                    event.select()
                    //return;
                }

                $.each(_itemsDetail, function(idx, v) {
                    if (parseInt(v.id) === parseInt(id)) {
                        //resultado = ((v.price * v.quantity) * v.exchange_rate)
                        _itemsDetail.splice(idx, 1);
                        v.discount = parseFloat(event.value);
                        _itemsDetail.push({
                            id: v.id
                            , ean: v.ean
                            , name: v.name
                            , price: v.price
                            , quantity: parseFloat(v.quantity)
                            , subtotal: parseFloat(((v.price * v.quantity) - v.discount) * v.exchange_rate)
                            , stock: v.stock
                            , discount: v.discount
                            , tax: v.tax
                            , category: v.category
                            , uom: v.uom
                            , exchange_rate: v.exchange_rate

                        });
                        $(`.subtotal${id}`).html(formatCurrency(parseFloat(((v.price * v.quantity) - v.discount) * v.exchange_rate)));
                        return false;
                    }
                });


                $.each(_itemsDetail, function(idx, v) {
                    _newItemsDetail.push(v);
                });

                //$(`.subtotal${id}`).html(formatCurrency(parseFloat(((_price * _quantity) * _exchange_rate))));
                $.each(_newItemsDetail, function(idx, v) {
                    _total += (((v.price * v.quantity) - v.discount) * v.exchange_rate)
                });

                _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
                _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;

                $(`.totalParcial`).html(formatCurrency(parseFloat(_subtotal)));
                $(`.taxTotal`).html(formatCurrency(parseFloat(_taxTotal)));
                $(`.grandTotal`).html(_label_tax_code + ' ' + formatCurrency(parseFloat(_total)));
                $('.btn-pay').html(formatCurrency(parseFloat(_total)));
                $('#amount_payable').val(formatCurrency(parseFloat(_total)));
                $('#cash_paid').val(formatCurrency(parseFloat(_total)));
                $('#grandTotal').val(_total);

                //Remove itemsDetail
                localStorage.removeItem('itemsDetail');

                //Create itemsDetail
                localStorage.setItem('itemsDetail', JSON.stringify(_newItemsDetail));
                console.log(_itemsDetail);
            }
        }
    }

    //Exchange rate
    const exhange_rate = function(currency) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/sales/exchangerate'
                , method: 'get'
                , dataType: 'json'
                , data: {
                    currency: currency
                }
            , }).done(resolve).fail(reject);
        });
    }

    //store
    const _store = function(obj) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/sales/store'
                , method: 'post'
                , dataType: 'json'
                , headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
                , data: {
                    parameters: obj
                }
            , }).done(resolve).fail(reject);
        });
    }

    //
    const cash_return = function(cash = 0) {
        let _to_pay = 0;
        if (localStorage.hasOwnProperty('payments')) {
            let _payments = JSON.parse(localStorage.getItem('payments'));
            _to_pay = Math.min.apply(Math, _payments.map(a => a.balance));
        } else {
            _to_pay = parseFloat($('#grandTotal').val());
        }

        let _remaining = 0;
        cash = parseFloat(cash);
        if (parseFloat(cash) > parseFloat(_to_pay)) {
            let _returned = (parseFloat(cash) - parseFloat(_to_pay));
            if ((_returned * 1) < 0) {
                $('#cash_returned').val(0.00);
                _remaining = _returned;
                $('#remaining_cash').val(formatCurrency(_remaining))
            } else {
                _remaining = cash - (_to_pay + _returned * 1);
                $('#cash_returned').val(formatCurrency(_returned));
                $('#remaining_cash').val(formatCurrency(_remaining));
            }
        } else {
            $('#cash_returned').val(0.00);
            _remaining = isNaN(_to_pay - (cash * 1)) ? 0.00 : _to_pay - (cash * 1);
            $('#remaining_cash').val(formatCurrency(_remaining));
        }
        if (_remaining > 0) {
            $('.remaining_cash').removeClass('hidden');
            $('#btnConfirm').addClass('hidden');
        } else {
            $('.remaining_cash').addClass('hidden');
            $('#btnConfirm').removeClass('hidden');
        }
    }

    //formatear el importe a moneda
    const formatCurrency = function(total) {
        var neg = false;
        if (total < 0) {
            neg = true;
            total = Math.abs(total);
        }
        return (neg ? "-" : '') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
    }

    //validate quantity field in search modal
    const validateInput = function(id) {
        let input = document.getElementById('quantity_add_' + id);
        let option = document.getElementById('item_uom' + id);
        let uom = option.options[option.selectedIndex].dataset.uom
        let _uom_primary = option.options[option.selectedIndex].dataset.uomprimary

        if (isEmpty(input.value)) {
            input.value = 1;
            input.select()
            return;
        } else {
            convertionRate(uom, _uom_primary).then(response => {
                let _convertion_rate = parseFloat(response.convertion_rate);
                let quantity = parseFloat(input.value * _convertion_rate);
                input.value = quantity;

            }).catch(error => {
                console.log(error)
            })
        }
    }

    //To checks for all 'empties' like null, undefined, '', ' ', {}, [].
    const isEmpty = function(data) {
        if (typeof(data) === 'object') {
            if (JSON.stringify(data) === '{}' || JSON.stringify(data) === '[]') {
                return true;
            } else if (!data) {
                return true;
            }
            return false;
        } else if (typeof(data) === 'string') {
            if (!data.trim()) {
                return true;
            }
            return false;
        } else if (typeof(data) === 'undefined') {
            return true;
        } else {
            return false;
        }
    }

    //close modal and reset values
    const closeModal = function() {
        $('#items').val('');
        $('#table-item-search tbody').empty();
        $('#modal-items').modal('hide');
        $('#codigo_articulo').focus().select();
        $('#codigo_articulo').val(null);
        $('#price').val(0);
        $('#quantity').val(0);
        $('.detail_item').addClass('hidden');
        $('.result_search').addClass('hidden');
    }

    const closeModalPayment = function() {
        $('#modal-payment').modal('hide');
        $('#amount_payable').val(formatCurrency($('#grandTotal').val()));
        $('#cash_paid').val(formatCurrency($('#grandTotal').val()));
        $('#remaining_cash').val(0.00);
        if (localStorage.hasOwnProperty('payments')) {
            localStorage.removeItem('payments');
        }
        $('#pay_table').addClass('hidden');
        $('#pay_table tbody').empty();
        $('#payment_method').val(1).change();
    }

    //price format
    const formatPrice = function(value) {
        let val = (value / 1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    // const _currency = function(money) {
    //     return money.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    // }

    const validateStock = function(id = 0) {
        let _stock = 0;
        let _quantity = 0;
        let _price = 0;
        let _discount = 0;
        let _name = '';
        let _tax = parseFloat($('#tax').val());
        let _currency_ = $('#currency').val();
        let _exchange_rate = 1;
        const _validateStock = '{{$validateStock}}';
        let _uomcode = '';
        let _category = 0;
        let _label_tax_code = (_currency_ === 'USD') ? '$' : '{{$site->label_tax_code}}'
        $('#btn-payment').removeClass('hidden');
        exhange_rate(_currency_).then(response => {

            if (response.status === 1) {
                _exchange_rate = parseFloat(response.data.exchange_rate);
            }

            if (parseInt(id) > 0) {
                let input = document.getElementById('itemQuantity' + id);
                _stock = input.getAttribute('data-stock');

                //if the field is null or zero set default 1
                // || parseFloat(input.value) <= 0
                if (isEmpty(input.value)) {
                    input.value = 1;
                    input.select()
                }
                _quantity = input.value;
                _price = input.getAttribute('data-price');
                _discount = input.getAttribute('data-discount');
                _category = input.getAttribute('data-category');
                _uomcode = input.getAttribute('data-uomcode');
                _name = input.getAttribute('data-product');
                //_tax = input.getAttribute('data-tax');
                if (parseFloat(_quantity) == 0) {
                    // message('Cantidad', `El articulo ${_name} no puede tener una cantidad menor o igual a 0`, 'error', 3500);
                    $('#btn-payment').addClass('hidden');
                }
            } else {
                _stock = parseFloat($('.item_stock').text());
                _quantity = parseFloat($('#quantity').val());
                _price = parseFloat($('#price').val());
                _discount = parseFloat($('#discount').val());
            }

            if (_validateStock) {
                if (parseFloat(_quantity) > parseFloat(_stock)) {
                    message('Stock', `La cantidad supera al stock actual : ${_stock}`, 'warning');
                    return;
                }
            }

            if (parseFloat(_quantity) > 0) {

                let _total = 0; //((_price * _quantity) - _discount);
                let _taxTotal = 0; // ((parseFloat(_total) * parseFloat(_tax)) / (1 + parseFloat(_tax)));
                let _subtotal = 0; //(parseFloat(_total) - parseFloat(_taxTotal));
                let _itemsDetail = [];
                let _newItemsDetail = [];
                if (localStorage.hasOwnProperty("itemsDetail")) {
                    _itemsDetail = JSON.parse(localStorage.getItem('itemsDetail'));
                }

                $.each(_itemsDetail, function(idx, v) {
                    if (parseInt(v.id) === parseInt(id)) {
                        _itemsDetail.splice(idx, 1);
                        v.exchange_rate = _exchange_rate;
                        _itemsDetail.push({
                            id: v.id
                            , ean: v.ean
                            , name: v.name
                            , price: v.price
                            , quantity: parseFloat(_quantity)
                            , subtotal: parseFloat((_price * _quantity) * v.exchange_rate)
                            , stock: v.stock
                            , discount: v.discount
                            , tax: v.tax
                            , category: v.category
                            , uom: v.uom
                            , exchange_rate: v.exchange_rate

                        });
                        return false;
                    }
                });

                $.each(_itemsDetail, function(idx, v) {
                    _newItemsDetail.push(v);
                });

                $(`.subtotal${id}`).html(formatCurrency(parseFloat(((_price * _quantity) * _exchange_rate))));
                $.each(_newItemsDetail, function(idx, v) {
                    _total += (((v.price * v.quantity) - v.discount) * v.exchange_rate)
                });

                _taxTotal = (parseFloat(_tax) * 1 * parseFloat(_total)) / 100;
                _subtotal = (((parseFloat(_total) - parseFloat(_taxTotal)) * 1) + 0) * 1;

                $(`.totalParcial`).html(formatCurrency(parseFloat(_subtotal)));
                $(`.taxTotal`).html(formatCurrency(parseFloat(_taxTotal)));
                $(`.grandTotal`).html(_label_tax_code + ' ' + formatCurrency(parseFloat(_total)));
                $('.btn-pay').html(formatCurrency(parseFloat(_total)));
                $('#amount_payable').val(formatCurrency(parseFloat(_total)));
                $('#cash_paid').val(formatCurrency(parseFloat(_total)));
                $('#grandTotal').val(_total);

                //Remove itemsDetail
                localStorage.removeItem('itemsDetail');

                //Create itemsDetail
                localStorage.setItem('itemsDetail', JSON.stringify(_newItemsDetail));
            }

        }).catch(error => {
            console.log(error);
        });
        return ((parseFloat(_quantity) > parseFloat(_stock) * _exchange_rate));
    }

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
