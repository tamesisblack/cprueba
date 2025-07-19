Vue.filter('limitText', function (value) {
    return value.substring(0, 30);
});

Vue.filter('money', function (value) {
    return numeral(value).format('0,0.00');
});

Vue.component('v-select', VueSelect.VueSelect);

var app = new Vue({
  el: '#app',
  data(){
  	return{
	  	selectVendors: [],
	  	vendor: '',	
	  	vendor_address: '',
	  	vendor_phone: '',
	  	selectArticles: [],
	  	articles: [],
	  	item_id: '',	  	
		uom_code: '',
		quantity: '',	 
	  	items: [],
	  	lines: 0,
		draft:{
			descripcion: '',
			quantity: '',
			unit_price:''
		},	  
		po_header_id: window.location.pathname.replace('/compras/orden/', '') ,	
		rates: [],
		currency: ''
  	}
  },

  mounted(){
  	this.getVendors();
  	this.currency = this.$refs.currency.value;
  },

	watch:{
		vendor: function(val){
			console.log(this.getVendor(val));
			this.$refs['vendor_id'].value = val.value;
			this.vendor_address = this.getVendor(val.value).address;
			this.vendor_phone = this.getVendor(val.value).telef1;
		},
		item_id: function (val){
			if (val != '') {
				this.uom_code = this.getArticle(val.value).primary_uom_code;
			}      	
		},

		currency: function(val){
			if (val != '' && val != this.$refs.defaultCurrency.value) {
				if (!this.$refs.rates.value.includes(val)) {
					alert('Debe registrar un tipo de cambio para el día de hoy');
					this.currency = '';
				}
			}
		},
	},

	methods:{
		getArticles: function(){
			var self = this;
			axios.get('/ventas/item/')
			  .then(function(response){
			    for (var i = response.data.length - 1; i >= 0; i--) {
			      self.selectArticles.push({
			        label:   response.data[i].codigo + ' - ' + response.data[i].nombre,
			        value:  response.data[i].inv_item_id
			      });    

			      self.articles.push({
				      item_id:  response.data[i].inv_item_id,
				      codigo:  response.data[i].codigo,
				      descripcion:  response.data[i].descripcion,
				      primary_uom_code:   response.data[i].primary_uom_code,
				      list_price_per_unit: response.data[i].list_price_per_unit,
				      category_id: response.data[i].idcategoria,
				      categoria: response.data[i].categoria,
				      allow_item_desc_update_flag: response.data[i].allow_item_desc_update_flag, 
				      RECOVERABLE_TAX: 0             
			      })        
			    }
			  })
			  .catch(function(error){
			    console.log(error);
			    alert('error');
			  });
		},

		getArticle: function(id){
			for (var i = this.articles.length - 1; i >= 0; i--) {
				if (this.articles[i].item_id === id) {
					return this.articles[i]
				}
			}
		},

		getVendors: function(){  		
			var self = this;
			axios.get('/compras/vendor')
				.then(function(response){
					console.log(response)
					for (var i = 0; i < response.data.length; i++) {
						self.selectVendors.push({
				                    value: response.data[i].vendor_id,
				                    label: response.data[i].vendor_name,
				                    address: response.data[i].address,
				                    telef1: response.data[i].telef1,
				                    tax_rate: response.data[i].tax.tax_rate,
						});

						if (response.data[i].vendor_id ==  self.$refs["vendor_id"].value) {
							self.vendor = {
					                    value: response.data[i].vendor_id,
					                    label: response.data[i].vendor_name  	
							};
						}						
					}
					self.vendor_id = self.$refs['vendor_id'].value;
					self.getDetail();
				})
				.catch(function(error){
					alert(error);
				})
		},

		getVendor: function(id){
			for (var i = this.selectVendors.length - 1; i >= 0; i--) {
				if (this.selectVendors[i].value === id) {
					return this.selectVendors[i]
				}
			}			
		},

		isFormValid: function(){
			return this.item_id && this.uom_code && this.quantity;
		},

		getCategory: function(id){
			for (var i = this.articles.length - 1; i >= 0; i--) {
				if (this.articles[i].item_id === id) {
					return this.articles[i].categoria.nombre;
				}
			}			
		},

		addItem: function(){
			var currentItem = this.getArticle(this.item_id.value);

			this.reorderLines();

			this.items.push({
				po_header_id: this.po_header_id,
				line_num: this.lines ,
				item_id: this.item_id.value,
				quantity: this.quantity,
			
				category_id: currentItem.category_id,		
				category_name: currentItem.categoria.nombre,		
				item_description: currentItem.descripcion,
				unit_meas_lookup_code: this.uom_code,
				unit_price: currentItem.list_price_per_unit,
				need_by_date: this.$refs['need_by_date'].value,
				  
				allow_item_desc_update_flag: currentItem.allow_item_desc_update_flag,
				editing: false,
				RECOVERABLE_TAX: ((this.getVendor(this.vendor.value).tax_rate 
					* this.quantity * currentItem.list_price_per_unit) / 100).toFixed(2),
			});
			this.clean();
		},

		reorderLines(){      
		  for (var i = 0; i < this.items.length; i++) {
		    this.items[i].line_num = i+1;
		  }
		  this.lines = this.items.length + 1;
		},

		getDetail: function(){
			this.clear();
			var self = this;
			axios.get('/compras/poDetail?id=' + this.po_header_id)
				.then(function(response){
					var data = response.data;
					console.log(data);
					for (var i = 0; i < data.length; i++) {
						self.items.push({
							po_header_id: data[i].po_header_id,
							line_num: data[i].line_num,
							item_id: data[i].item_id,
							quantity: data[i].quantity,
						 
							category_id: data[i].category_id,
							category_name: data[i].categoria.nombre,
							item_description: data[i].item_description,
							unit_meas_lookup_code: data[i].unit_meas_lookup_code,
							unit_price: data[i].unit_price,
							need_by_date: data[i].need_by_date,
							allow_item_desc_update_flag: data[i].allow_item_desc_update_flag,
							RECOVERABLE_TAX: ((self.getVendor(self.vendor.value).tax_rate * data[i].quantity 
								* data[i].unit_price) / 100).toFixed(2),
							editing: false,							
						})
					}
				})
				.catch(function(error){
					alert(error);
				});
		},

		editItem: function(index){
		      this.uncheckAll();
		      this.items[index].editing = true;
		      this.draft.unit_price = this.items[index].unit_price;
		      this.draft.quantity = this.items[index].quantity;
		      this.draft.descripcion = this.items[index].item_description;			
		},

		saveItem: function(index){
			this.items[index].editing = false;

			this.items[index].unit_price = this.draft.unit_price;
			
			this.items[index].quantity = this.draft.quantity;

			this.items[index].item_description = this.draft.descripcion;	

			this.draft.unit_price = '';
			
		},

		undoItem: function(index){
			this.items[index].editing = false;
			this.draft.unit_price = '';
			this.draft.quantity = '';
			this.draft.descripcion = '';
		},

		removeItem: function(index)		{
		      this.items.splice(index, 1);
		      this.reorderLines();
		},

		uncheckAll: function(){
			for (var i = this.items.length - 1; i >= 0; i--) {
				this.items[i].editing = false;
			}
		},	

		isEditing: function(index)
		{
			return this.items[index].editing;
		},

		calculeExtendedAmount: function(index){
			return this.items[index].unit_price * this.items[index].quantity;
		},		

		saveDetail:function(){
			axios.post('/compras/poDetail', this.items) .then(function(response){
					alert(response.data.message);
				})
				.catch(function(error){
					alert(error);
				})
		},

		clear:function(){
			this.items = [];
		},

		clean: function(){
			this.item_id = '';
			this.quantity = '';
		},

		approve: function(){
			if (confirm('Desea aprobar la orden?')) {
			    axios.put('/compras/approveOrder/' + this.po_header_id)
			    	.then(function(response){
			    		alert(response.data.message);
			    	})
			    	.catch(function(error){
			    		alert(error);
			    	});
			} 
		},

	},

	computed:{
		totalOrden: function(){
			var total = 0;
			for (var i = this.items.length - 1; i >= 0; i--) {
				total +=  this.items[i].quantity * this.items[i].unit_price;
			}
			return  total;
		},		

		totalTax: function(){
			var total = 0;
			for (var i = this.items.length - 1; i >= 0; i--) {
				total +=  +this.items[i].RECOVERABLE_TAX;
			}
			return total;
		},

	}

});