Vue.filter('money', function (value) {
    return numeral(value).format('0,0.00');
});

Vue.component('v-select', VueSelect.VueSelect);

$('#status').css('pointer-events','none');

var app = new Vue({
  el: '#app',
  data: {
    cash_receipt_id: window.location.pathname.replace('/ventas/recibo/', ''),
    clients: [],
    selectClients: [],
    client: null,
    bills: [],
    selectBills: [],
    items: [],
    item_id: '',
    item_importe: 0,
    item_descuento: 0,
    receipt_date: '',
    modalTitle: '',
    modalMessage: '',
    billBalance: '',
    receiptAmount: 0,
    address: '',
    telef1: '',

  },
  mounted(){
  	var self = this;

        this.getBills();
        axios.get('/ventas/clienteFa') 
        .then(function (response) {          
          var clients = response.data;
          for (var i = clients.length - 1; i >= 0; i--) {
              self.selectClients.push({
                label: clients[i].first_name + ' ' + clients[i].first_last_name,
                value: clients[i].idcliente
              });
               self.clients.push({
                  idcliente: clients[i].idcliente,
                  first_name: clients[i].first_name,
                  second_name: clients[i].second_name,
                  first_last_name: clients[i].first_last_name,
                  second_last_name: clients[i].second_last_name,
                  num_documento: clients[i].num_documento,
                  telef1: clients[i].telef1,
                  address: clients[i].address
               })
               
               if (clients[i].idcliente ==  self.$refs["pay_from_customer"].value) {
                self.client = {
                  value :clients[i].idcliente,
                  label: clients[i].first_name + ' ' + clients[i].first_last_name
                };
              }              
               
          }
        })
        .catch(function(error){
          console.log(error);
          self.modalTitle = 'Error de Comunicación';
          self.modalMessage = 'Los clientes no fueron cargados, si persiste éste error comuniqese con el administrador';
          $('#messageModal').modal('show');       
        }) 	
  },

  watch: {
    item_id: function(bill){
      if (bill != '') {
        this.billBalance = this.round(this.getBill(bill.value).balance);        
        this.item_importe = this.round(this.getBill(bill.value).balance);        
      }
    },

    client: function(val){
      if(this.$refs["status"].value != 'REV'){
        this.$refs["status"].value = (val == null) ? 'unid' : 'UNAPP';        
      }
       if (val != '') {
          var currentClient = this.getClient(val.value);
           this.address =  currentClient.address;
           this.telef1 =  currentClient.telef1;
       }        

    },

    item_importe: function(val){
      if (+ this.round(val) + + this.round(this.item_descuento) + + this.round(this.totalImporte) > this.round( this.$refs["amount"].value)) {

        alert('No puede exceder el monto de recibo');

        this.item_importe = parseFloat(parseFloat(this.$refs["amount"].value).toFixed(2) - parseFloat(this.totalImporte).toFixed(2)).toFixed(2);

      }
      else if (+val + +this.item_descuento > this.billBalance){

        alert('No puede exceder el monto de la factura');

        this.item_importe = parseFloat(parseFloat(this.billBalance).toFixed(2) - parseFloat(this.item_descuento).toFixed(2));

      }

    },

    item_descuento: function(val){
      if (+val + +this.item_importe > this.billBalance) {

        alert('No puede exceder el monto de la factura');

        this.item_descuento =  parseFloat(parseFloat(this.billBalance).toFixed(2) - parseFloat(this.item_importe).toFixed(2)).toFixed(2);
      }
    }

  },

  methods:{    
    getDetail: function(){
      var self = this;
      axios.get('/ventas/reciboDetalle/' + this.cash_receipt_id)
      .then(function(response){
        self.items = []; 
        var data = response.data;
        for (var i = 0; i < data.length; i++) {
          if (data[i].terms.length > 0){
            var customer_trx_id = data[i].customer_trx_id + '-' + data[i].terms[0].term;
          }
          else{
            var customer_trx_id = data[i].customer_trx_id;
          }
          var currentBill = self.getBill(customer_trx_id);
        
          self.items.push({
            customer_trx_id: currentBill.customer_trx_id,
            trx_number: currentBill.trx_number,
            receipt_date: self.$refs["receipt_date"].value,
            cash_receipt_id: data[i].cash_receipt_id,
            amount_applied: data[i].amount_applied,
            discount_original: data[i].discount_original,
            amount_due_remaining: data[i].amount_due_remaining,
            currency_code: currentBill.currency_code,
            term: (data[i].terms.length > 0) ? data[i].terms[0].term : 1,
          });               
        }
      })
      .catch(function(error){
        console.log(error);
      });
      this.receiptAmount = parseFloat(this.$refs["amount"].value);
    },

    getBills: function(){
      var self = this;
      axios.get('/ventas/clienteFa/' + this.$refs["pay_from_customer"].value)
      .then(function(response){
        console.log(response);
        data = response.data;
        for (var i = data.length - 1; i >= 0; i--) {    
          var terms = data[i].terms;
            if (terms.length == 0){ 

              if (data[i].balance > 0) {
                  self.selectBills.push({
                    value: data[i].customer_trx_id,
                    label: '#' +data[i].trx_number
                  });
              }
              self.bills.push({
                customer_trx_id: data[i].customer_trx_id,
                trx_number: data[i].trx_number,
                balance: data[i].balance,
                currency_code: data[i].bill_currency.descripcion,
                term: '1'
              });     

            }
            else{             

              for (var j = 0; j < terms.length; j++) {
                if (terms[j].balance != 0) {
                  self.selectBills.push({
                    value: data[i].customer_trx_id + '-' + terms[j].term,
                    label: '#' + data[i].trx_number + '(Plazo - ' + terms[j].term + ')',
                  });      
                }

                self.bills.push({
                  customer_trx_id: data[i].customer_trx_id + '-' +  terms[j].term,
                  trx_number: data[i].trx_number,
                  balance:  terms[j].balance,
                  currency_code: data[i].bill_currency.descripcion,
                  term: terms[j].term,
                }); 

              }
            } 
        }
      })
      .catch(function(error){
          console.log(error);
          self.modalTitle = 'Error de Comunicación';
          self.modalMessage = 'Los clientes no fueron cargados, si persiste éste error comuniqese con el administrador';
          $('#messageModal').modal('show');
      })
    },

    addItem: function () {
      var currentBill = this.getBill(this.item_id.value);

      var remain = +[parseFloat(currentBill.balance).toFixed(2) - parseFloat(this.item_importe).toFixed(2) - parseFloat(this.item_descuento).toFixed(2)];

      this.items.push({
        customer_trx_id: currentBill.customer_trx_id,
        trx_number: currentBill.trx_number,
        receipt_date: this.$refs["receipt_date"].value,
        cash_receipt_id: this.cash_receipt_id,
        amount_applied: this.item_importe,
        discount_original: this.item_descuento,
        amount_due_remaining:(remain < 0.01) ? 0 : remain,
        currency_code: currentBill.currency_code,
        term: currentBill.term,
      });     

      currentBill.balance -=  this.item_importe -this.item_descuento;

      if (this.round(currentBill.balance) == 0) {
        this.deleteSelectBill(currentBill.customer_trx_id);
      }

      this.clearItems();
    },

    removeItem: function(index){
      var currentBill = this.getBill(this.items[index].customer_trx_id)
      currentBill.balance += parseFloat(this.items[index].amount_applied) + parseFloat(this.items[index].discount_original);
      this.selectBills.push({
              value: currentBill.customer_trx_id,
              label: '#' +currentBill.trx_number
      });

      this.items.splice(index, 1);
    },

    clearItems: function(){
      this.item_id = '';
      this.billBalance = 0;
      this.item_importe = 0;
      this.item_descuento = 0;
    },

    getBill: function(customer_trx_id){
      for (var i = 0; i < this.bills.length; i++) {
        if (this.bills[i].customer_trx_id == customer_trx_id) {
          return this.bills[i];          
        }
      }
    },

    deleteSelectBill: function(value){
      for (var i = 0; i < this.selectBills.length; i++) {
        if (this.selectBills[i].value == value) {
          this.selectBills.splice(i, 1);          
        }
      }
    },    

    isFormValid: function(){
      return this.item_id != '' && this.item_importe >= 0 && this.item_descuento >= 0;     
    },

    setHiddens: function(){
      if( this.client != ''){
        this.$refs["pay_from_customer"].value = this.client.value;        
      }   	
     },

    saveDetail: function(){
      var self = this;
      axios.post('/ventas/reciboDetalle', self.items)
        .then(function (response) {
          console.log(parseFloat(self.receiptAmount) - parseFloat(self.totalImporte));
          if (self.round(self.receiptAmount) - self.round(self.totalImporte) == 0) {
            self.$refs["status"].value = 'comp';            
          }
          self.$refs["totalImporte"].value = numeral( self.totalImporte).format('0,0.00');
          self.$refs["porAplicar"].value =  numeral(self.porAplicar).format('0,0.00');
          self.modalTitle = response.data.title;
          self.modalMessage = response.data.message;
          $('#messageModal').modal('show');             
        })
        .catch(function (error) {
          console.log(error);    
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'el detalle no fue guardado, si la falla persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');                
        });    
    },     

    clearDetail: function(){
      this.items = [];
    },

    round: function(val){
      return parseFloat(val).toFixed(2);
    },
  
  getClient(id){
      for (var i = this.clients.length - 1; i >= 0; i--) {
        if (this.clients[i].idcliente == id) {
          return{
            address: this.clients[i].address,
            telef1: this.clients[i].telef1,
            dni: this.clients[i].num_documento
          };                
        }
      }
    }

  },
  
  computed:{
    totalImporte: function(){      
      var total = 0;
      for (var i = 0; i < this.items.length; i++) {
        total += parseFloat(this.items[i].amount_applied);
      }
      //return total;
      return total;
    },
    porAplicar: function(){
      return this.round(this.receiptAmount) - this.round(this.totalImporte);
    }
  }
})