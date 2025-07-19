<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Crear Transacción</h3>
        </div>
        <div class="box-body">
            <div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="form-group" :class="{'has-error': this.errors.hasOwnProperty('transaction_type_id')}">
                        <label>Tipo</label>
                        <select name="" v-model="transaction_type_id" class="form-control">
                            <option v-for="item in itemsType" :value="item.transaction_type_id">{{ item.transaction_type_name }}</option>
                        </select>
                    </div>
                    <div class="form-group" :class="{'has-error': this.errors.hasOwnProperty('transaction_date')}">
                        <label>Fecha:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" :value="this.transaction_date" readonly="true">
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Sub Inventario</th>
                        <th>Localizador</th>
                        <th width="80px">Cantidad</th>
                        <th>UDM</th>
                        <th>Tipo Documento</th>
                        <th>Nro. Doc.</th>
                        <th>Referencia</th>
                        <th>Observaciones</th>
                        <th width="50px"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr is="transaction-row-editing" v-for="(transaction, index) in transactions"
                            :items="items" :subinventarios="subinventarios"
                            :locations="locations" :uoms="uoms" :docsType="docsType"
                            :transaction="transaction" :index="index" @removeTransaction="remove"></tr>

                        <tr is="transaction-row" :items="items" :subinventarios="subinventarios"
                            :locations="locations" :uoms="uoms" :docsType="docsType"
                            :transaction="newTransaction" @addrow=pushRow></tr>
                    </tbody>
                </table>
                <button class="btn btn-danger" type="button" @click="guardarDatos()" :disabled="disableButton">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['transaction_date'],
        data () {
            return {
                errors: {},
                newTransaction: {
                    item_id: '', subinventory_id: '', transaction_quantity: 1,
                    transaction_uom_id: '', locator_id: '', type_doc_id: '', num_doc: '', ref_doc: '', obs_doc: ''
                },
                items: [],
                tipo: {},
                itemsType: [],
                transaction_type_id: '',
                transaction_date: '',
                subinventarios: [],
                locations: [],
                uoms: [],
                docsType: [],
                disableButton: false,
                transactions: []
            }
        },
        methods: {
            pushRow (transaction) {
                this.transactions.push(transaction);
                this.newTransaction = {
                    item_id: '', subinventory_id: '', transaction_quantity: 1,
                    transaction_uom_id: '', locator_id: '', type_doc_id: '', num_doc: '', ref_doc: '', obs_doc: ''
                }
            },
            remove (index) {
                this.transactions.splice(index, 1);
            },
            guardarDatos () {
                if (this.validate()) {
                    if(confirm('Desea guardar la transacción'))
                    {
                        this.disableButton = true;
                        axios.post('/almacen/transactions', {
                            transactions: this.transactions,
                            transaction_type_id: this.transaction_type_id,
                            transaction_date: this.transaction_date,
                            _token: $('#token').val()
                        }).then(res => {
                            this.disableButton = false;
                            if (res.data.ok) {
                                alert('Se registró correctamente la transacción');
                                window.location.reload();
                            } else {
                                alert(res.data.mensaje);
                            }
                        })
                    }
                }
            },
            validate() {
                this.errors = {};

                if(this.transaction_type_id == '') {
                    this.errors.transaction_type_id = true;
                }
                if(this.transaction_date == '') {
                    this.errors.transaction_date = true;
                }

                if(this.errors.hasOwnProperty('transaction_type_id') || this.errors.hasOwnProperty('transaction_date')) {
                    return false;
                }

                return true;
            }
        },
        mounted() {
            axios.post('/item-type/get-all').then(res => {
               this.itemsType = res.data;
            });
            axios.post('/almacen/item/get-all').then(res => {
                this.items = res.data;
            });
            axios.post('/almacen/sub-inventarios/get-all').then(res => {
                this.subinventarios = res.data;
            });
            axios.post('/almacen/locator/get-all').then(res => {
                this.locations = res.data;
            });
            axios.post('/almacen/uom/get-all').then(res => {
                this.uoms = res.data;
            });
            axios.post('/almacen/fnd-lookup-value/get-all').then(res => {
                this.docsType = res.data;
            })
        }
    }
</script>
