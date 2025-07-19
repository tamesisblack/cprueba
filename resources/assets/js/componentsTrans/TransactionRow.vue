<template>
    <tr>
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
        <td :class="{'has-error': errors.hasOwnProperty('transaction_uom_id')}">
            <select name="" class="form-control" v-model="transaction.transaction_uom_id">
                <option value=""></option>
                <option v-for="unit in uoms" :value="unit.iduom">{{ unit.uom }}</option>
            </select>
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
            <a href="#" @click.prevent="addRow"><i class="fa fa-check" aria-hidden="true"></i></a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['items', 'subinventarios', 'locations', 'uoms', 'docsType', 'transaction'],
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
        methods: {
            addRow () {
                if(this.validate())
                {
                    this.$emit('addrow', this.transaction);
                }
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
