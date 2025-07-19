<template>
    <tr>
        <template v-if="editing">
            <td :class="{'has-error': errors.hasOwnProperty('item_id')}">
                <select name="" class="form-control" v-model="transaction.item_id">
                    <option value="">Seleccione Artículo</option>
                    <option v-for="item in items" :value="item.inv_item_id">{{item.codigo}}, {{item.nombre}}</option>
                </select>
            </td>
            <td :class="{'has-error': errors.hasOwnProperty('subinventory_id')}">
                <select name="" class="form-control" v-model="transaction.subinventory_id">
                    <option value=""></option>
                    <option v-for="sub in subinventarios" :value="sub.subinvid">{{ sub.name }}</option>
                </select>
            </td>
            <td :class="{'has-error': errors.hasOwnProperty('locator_id')}">
                <select name="" class="form-control" v-model="transaction.locator_id">
                    <option value=""></option>
                    <option v-for="locator in filterLocations" :value="locator.location_id">{{ locator.concaneted_segments }}</option>
                </select>
            </td>
            <td :class="{'has-error': errors.hasOwnProperty('transaction_quantity')}">
                <input type="number" class="form-control" v-model="transaction.transaction_quantity">
            </td>
            <td>
                {{ transaction.primary_uom_code }}
            </td>
            <td>
                <select name="" class="form-control" v-model="transaction.type_doc_id">
                    <option value=""></option>
                    <option v-for="type in docsType" :value="type.idlookup">{{ type.code_value }}</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control" v-model="transaction.num_doc">
            </td>
            <td>
                <input type="text" class="form-control" v-model="transaction.ref_doc">
            </td>
            <td>
                <input type="text" class="form-control" v-model="transaction.obs_doc">
            </td>
            <td valign="center">
                <a href="#" @click.prevent="addRow" style="color: #dd4b39"><i class="fa fa-check" aria-hidden="true"></i></a>
                <a href="#" @click.prevent="descartar"><i class="fa fa-times" aria-hidden="true"></i></a>
            </td>
        </template>
        <template v-else>
            <td>{{ itemName() }}</td>
            <td>{{ subName() }}</td>
            <td>{{ locName() }}</td>
            <td>{{ transaction.transaction_quantity }}</td>
            <td>{{ transaction.primary_uom_code }}</td>
            <td>{{ tipoDocName() }}</td>
            <td>{{ transaction.num_doc }}</td>
            <td>{{ transaction.ref_doc }}</td>
            <td>{{ transaction.obs_doc }}</td>
            <td>
                <a href="#" @click.prevent="edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                <a href="#" @click.prevent="remove(index)"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </td>
        </template>
    </tr>
</template>

<script>
    export default {
        props: ['items', 'subinventarios', 'locations', 'uoms', 'docsType', 'transaction', 'index'],
        data () {
            return {
                draft: {},
                errors: {},
                editing: false,
            }
        },
        computed: {
            filterLocations () {
                if(this.transaction.subInvetario_id == '') {
                    return [];
                }

                return this.locations.filter(l => l.subinventory_id == this.transaction.subinventory_id)
            }
        },
        watch: {
            'transaction.item_id' () {
                if(this.transaction.item_id != '') {
                    this.transaction.primary_uom_code = this.items.filter(i => i.inv_item_id == this.transaction.item_id)[0].primary_uom_code
                    this.transaction.locator_id = this.items.filter(i => i.inv_item_id == this.transaction.item_id)[0].locator_id
                    this.transaction.subinventory_id = this.locations.filter(l => l.location_id == this.transaction.locator_id )[0].subinventory_id
                } else {
                    this.transaction.primary_uom_code = ''
                    this.transaction.subinventory_id = ''
                    this.transaction.locator_id = ''
                }
            }
        },
        methods: {
            itemName () {
                var im = this.items.filter(i => i.inv_item_id == this.transaction.item_id)[0];
                return im.codigo + ', ' + im.nombre;
            },
            subName () {
               var sub = this.subinventarios.filter(s => s.subinvid == this.transaction.subinventory_id)[0];
               return sub.name
            },
            locName() {
                return this.locations.filter(l => l.location_id == this.transaction.locator_id &&
                l.subinventory_id == this.transaction.subinventory_id)[0].concaneted_segments;
            },
            tipoDocName() {
                if(this.transaction.type_doc_id == '') {
                    return ''
                }
                return this.docsType.filter(d => d.idlookup = this.transaction.type_doc_id)[0].code_value;
            },
            addRow () {
                if(this.validate())
                {
                    this.editing = false;
                }
            },
            edit () {
                this.draf = this.transaction;
                this.editing = true;
            },
            descartar () {
                this.transaction = this.draf;
                this.editing = false;
            },
            remove(index) {
                this.$emit('removeTransaction', index);
            },
            validate () {
                this.errors = {};
                if (this.transaction.item_id == '') {
                    this.errors.item_id = true;
                }
                if (this.transaction.subinventory_id == '') {
                    this.errors.subinventory_id = true;
                }
                if (this.transaction.locator_id == '') {
                    this.errors.locator_id = true;
                }
                if (this.transaction.transaction_quantity < 1) {
                    this.errors.transaction_quantity = true;
                }
                if (this.transaction.transaction_uom_id == '') {
                    this.errors.transaction_uom_id = true;
                }

                if(this.errors.hasOwnProperty('item_id') || this.errors.hasOwnProperty('subinventory_id') ||
                    this.errors.hasOwnProperty('locator_id') || this.errors.hasOwnProperty('locator_id') ||
                    this.errors.hasOwnProperty('transaction_quantity') || this.errors.hasOwnProperty('transaction_uom_id'))
                {
                    return false;
                }
                return true;
            }
        },
    }
</script>
