window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.component('transaccion-crear', require('./components/TransaccionCrear.vue'));
Vue.component('transaction-row', require('./components/TransactionRow.vue'));
Vue.component('transaction-row-editing', require('./components/TransactionRowEditing.vue'));

const vm = new Vue({
    el: '#app',
});

