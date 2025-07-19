Vue.filter('money', function (value) {
    return numeral(value).format('0,0.00');
});

Vue.filter('taxName', function (value) {
  for (var i = app.taxes.length - 1; i >= 0; i--) {
    if (value == app.taxes[i].tax_id) {
      return app.taxes[i].name;
    }
  }
});

Vue.filter('limitText', function (value) {
    return value.substring(0, 30);
});


Vue.component('v-select', VueSelect.VueSelect);

var app = new Vue({
  el: '#app',
  data: {
    item_id: '',
    billClient: '',
    shipClient: '',
    clients: [],
    selectClients: [],
    articles: [],
    selectArticles: [],
    lines: 0,
    items:[],
    url:  window.location.pathname,
    customer_trx_id: window.location.pathname.replace('/ventas/factura/', '') ,
    modalTitle: '',
    modalMessage:'',
    taxes: [],
    newItem:{
      uom_code: '',
      quantity_ordered: '',
      taxSelected: '',
      service_item_flag: '',  
    },
    draft:{
      description: '',
      unit_selling_price:''
    },
    billTo:{
      idcliente:'',
      address:'',
      dni:'',
    },
    shipTo:{
      idcliente:'',
      address:'',
      dni:'',      
    },
    isCompleted: false,
    class_trx: '',
  },

  mounted() {      
      this.isCompleted = this.$refs["complete_flag"].value == 'Y';
      this.sw = true;
      var self = this;
      if (this.url != '/ventas/factura'){

        if (this.url != '/ventas/factura/create') {

          this.getDetail();                
  
        
        axios.get('/ventas/item/')
          .then(function(response){
            for (var i = response.data.length - 1; i >= 0; i--) {
              self.selectArticles.push({
                label:  response.data[i].nombre,
                value:  response.data[i].inv_item_id
              });    

              self.articles.push({
              item_id:  response.data[i].inv_item_id,
              codigo:  response.data[i].codigo,
              description:  response.data[i].descripcion,
              primary_uom_code:   response.data[i].primary_uom_code,
              unit_selling_price: response.data[i].price_sell,
              service_item_flag: response.data[i].service_item_flag,              
              })        
            }
          })
          .catch(function(error){
            console.log(error);
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'Los articulos no fueron cargados, si persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');
          });

        axios.get('/ventas/tax')
          .then(function (response) {
            data = response.data;
            
              for (var i = data.length - 1; i >= 0; i--) {
                self.taxes.push({
                    tax_id:  data[i].tax_id,
                    name: data[i].name,
                    tax_rate: data[i].tax_rate,
                    selected: data[i].selected
                });

                if (data[i].selected) {
                  self.newItem.taxSelected = data[i].tax_id;
                }

              }
          })
          .catch(function (error) {            
            console.log(error);
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'Los impuestos no fueron cargados, si persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');            
          });   
        }

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
                 
                 if (clients[i].idcliente ==  self.$refs["ship_to_customer_id"].value) {
                  self.shipClient = {
                    value :clients[i].idcliente,
                    label: clients[i].first_name + ' ' + clients[i].first_last_name
                  };
                }

                 if (clients[i].idcliente ==  self.$refs["bill_to_customer_id"].value) {
                  self.billClient = {
                    value :clients[i].idcliente,
                    label: clients[i].first_name + ' ' + clients[i].first_last_name
                  };
                }
                 
            }

          })
          .catch(function (error) {
            console.log(error);
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'Los clientes no fueron cargados, si persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');            
          });        

      }
  },  

  watch: {
    item_id: function (val){
      if (val != '') {
      console.log(this.getArticle(val.value));
        this.newItem.uom_code = this.getArticle(val.value).primary_uom_code;
      }      

    },
    shipClient: function(val) {
       if (val != '') {
          var currentClient = this.getClient(val.value);
           this.shipTo.address =  currentClient.address;
           this.shipTo.telef1 =  currentClient.telef1;
           this.shipTo.dni =  currentClient.dni;      
       }        
    },

    billClient: function(val) {
       if (val != '') {
          var currentClient = this.getClient(val.value);
           this.billTo.address =  currentClient.address;
           this.billTo.telef1 =  currentClient.telef1;
           this.billTo.dni =  currentClient.dni;      
       }        
    },
    isCompleted:function(val){
      if (this.sw == true) {
        return this.isCompleted == 'N';        
      }
    }    
  },


  methods:{
    getDetail: function(){
      this.items = [];
      var self = this;
      axios.get('/ventas/facturaDetalle/'+this.customer_trx_id)
        .then(function (response) {          
          data = response.data;
            for (var i = data.length - 1; i >= 0; i--) {
            self.items.push({
              line_number: data[i].line_number,
              customer_trx_id: data[i].customer_trx_id,
              item_id: data[i].item_id,
              codigo: data[i].item_id,
              description: data[i].description,
              uom_code:  data[i].uom_code,
              quantity_ordered: data[i].quantity_ordered,
              unit_selling_price: data[i].unit_selling_price,
              extended_amount: data[i].extended_amount,
              tax_id: data[i].tax_id,
              service_item_flag:  data[i].service_item_flag,
              editing: false
            });     
           }            
           self.lines = self.items.length  ;
        })
        .catch(function (error) {
          console.log(error);
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'El detalle de la factura no fue cargado, si persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');          
        });  
    },    

    addItem: function () {
      if (this.isFormValid()) 
      {        
        var currentItem = this.getArticle(this.item_id.value);

        this.reorderLines();

        this.items.push({
          line_number: this.lines,
          customer_trx_id: this.customer_trx_id,
          item_id: currentItem.item_id,
          codigo: currentItem.codigo,
          description: currentItem.description,
          uom_code:  this.newItem.uom_code,
          quantity_ordered: this.newItem.quantity_ordered,
          unit_selling_price: currentItem.unit_selling_price,
          extended_amount: this.newItem.quantity_ordered * currentItem.unit_selling_price,
          tax_id: this.newItem.taxSelected,
          service_item_flag: currentItem.service_item_flag,
          editing: false
        }); 

          this.item_id = '';
          this.newItem.uom_code = '';
          this.newItem.quantity_ordered = '';           
      }

    },    

    editItem: function(index){      
      this.uncheckAll();
      this.items[index].editing = true;
      this.draft.unit_selling_price = this.items[index].unit_selling_price;
      this.draft.description = this.items[index].description;
    },

    saveItem: function(index){
      this.items[index].editing = false;

      this.items[index].unit_selling_price = this.draft.unit_selling_price;
      this.items[index].description = this.draft.description;
      this.items[index].extended_amount = this.calculeExtendedAmount(index);

      this.draft.unit_selling_price = '';
      this.draft.description = '';
    },

    undoItem: function(index){
      this.items[index].editing = false;
      this.draft.unit_selling_price = '';
      this.draft.description = '';
    },

    removeItem: function(index){
      this.items.splice(index, 1);
      this.reorderLines();
    },

    uncheckAll: function(){
      for (var i = this.items.length - 1; i >= 0; i--) {
        this.items[i].editing = false;
      }
    },

    isFormValid: function(){
      return this.item_id != '' && this.newItem.uom_code != '' && this.newItem.quantity_ordered > 0;     
    },

    saveDetail: function(){
      var self = this;
      axios.post('/ventas/facturaDetalle', self.items) 
        .then(function (response) {
          $('#detailModal').modal('hide');
          self.modalTitle = response.data.title;
          self.modalMessage = response.data.message;
          $('#messageModal').modal('show');
          
        })
        .catch(function (error) {
          console.log(error);    
            self.modalTitle = 'Error de Comunicación';
            self.modalMessage = 'el detalle no fue guardado, si la persiste éste error comuniqese con el administrador';
            $('#messageModal').modal('show');                
        });      
    },

    tax: function(tax_id){
      for (var i = this.taxes.length - 1; i >= 0; i--) {
        if (tax_id == this.taxes[i].tax_id) {
        return this.taxes[i].tax_rate;          
        }
      }
    },

    isEditing: function(index)
    {
      return this.items[index].editing;
    },

    calculeExtendedAmount: function(index){
      return this.items[index].unit_selling_price * this.items[index].quantity_ordered;
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
    },

    getArticle: function(id){
      for (var i = this.articles.length - 1; i >= 0; i--) {
        if (this.articles[i].item_id === id) {
          return {
            item_id: this.articles[i].item_id,
            codigo: this.articles[i].codigo,
            description: this.articles[i].description,
            primary_uom_code: this.articles[i].primary_uom_code,
            service_item_flag: this.articles[i].service_item_flag,
            unit_selling_price: this.articles[i].unit_selling_price
          };
        }
      }
    },

    setHiddens: function(){
       this.$refs["class_trx"].value =  this.$refs["trx_number"].value.toString() +  this.$refs["class_code"].value.toString();
      if( this.shipClient != ''){
        this.$refs["ship_to_customer_id"].value = this.shipClient.value;        
      } 
      if (this.billClient != '') {
        this.$refs["bill_to_customer_id"].value = this.billClient.value;              
      }
    },
    reorderLines(){      
      for (var i = 0; i < this.items.length; i++) {
        this.items[i].line_number = i+1;
      }
      this.lines = this.items.length + 1;
    },
    changeComplete(){
        this.isCompleted = false;        
    }
  },

  computed:{
    totalFactura: function(){
      var total = 0;
      for (var i = this.items.length - 1; i >= 0; i--) {
        total +=  this.items[i].quantity_ordered * this.items[i].unit_selling_price;
      }
      return  total;
    },
    totalTax: function(){
      var total = 0;
      for (var i = this.items.length - 1; i >= 0; i--) {
        total +=  this.items[i].quantity_ordered * this.items[i].unit_selling_price * (this.tax(this.items[i].tax_id)/100);
      }
      return  total;      
    }
  }

})  ;