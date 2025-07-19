Vue.filter('money', function (value) {
    return numeral(value).format('0,0.00');
});

var app = new Vue({
  el: '#app',
  data: {
  	terms: [],
  	new_amount: '',
  },

  mounted(){
    var self = this;
    axios.get('/ventas/plazo/' + this.$refs['customer_trx_id'].value)
      .then(function(response){
          var data = response.data;
          console.log(data);
          for (var i = 0; i < data.length; i++) {
                  self.terms.push({
                  customer_trx_id:data[i].customer_trx_id,
                  term: data[i].term,
                  amount: data[i].amount,
                  balance: data[i].balance,
                  due_date: data[i].due_date.substring(0, 10),
                  pay_date: data[i].pay_date.substring(0, 10),
                  status: data[i].status,
          });          
      }
      })
      .catch(function(error){
        console.log(error);
      });
  },

  watch:{
    new_amount: function(val){
      if (parseFloat(val) > this.remain) {
        alert('Monto de factura superado');
        this.new_amount = this.remain;
      }
    }
  },

  methods:{
  	add: function(){
  		this.terms.push({
                customer_trx_id: this.$refs['customer_trx_id'].value,
                term: this.terms.length + 1,
                amount: this.new_amount,
                due_date: this.$refs['date'].value,
                status: 'No Pagado'
  		});
        this.new_amount = '';
  	},
  	remove: function(index)
  	{
  		this.terms.splice(index, 1);
  		this.reorderLines();
  	},
      save: function(){ 
        axios.post('/ventas/plazo', this.terms)
          .then(function(response){
            alert(response.data.message);
            window.location.replace('/ventas/factura');
          })
          .catch(function(error){
            alert(error);
          });
      },
    	reorderLines: function(){      
	      for (var i = 0; i < this.terms.length; i++) {
	        this.terms[i].term = i +1;
	      }
      },
      round: function(val){
      	return parseFloat(val).toFixed(2);
      },    
      isValid: function(){
        return this.new_amount > 0;
      }  	
  },
  computed:{
  	total: function(){
  		var total = 0;
	      for (var i = 0; i < this.terms.length; i++) {
	        total +=parseFloat(this.terms[i].amount);
	      }  		
	      return total.toFixed(2);  	
	 },
	 remain: function(){
	 	return this.round(this.round(this.$refs['amount'].value) - this.round(this.total));
	 },
  }
})