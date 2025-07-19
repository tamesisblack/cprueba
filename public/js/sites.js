var app = new Vue({
  el: '#app',
  data(){
  	return{
  		email:'',
  		userSites: [],
  	}
  },

  methods:{
  	getUserSites(email){
  		var self = this  		
		axios.get('/emailSite/' + email)
		.then(function(response){		
			console.log(response.data)		;
			self.userSites = response.data;
		})
		.catch(function(error){
			alert(error);
		});  			

  	},

	isEmailValid(){
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(this.email);
	},  	
  },

  watch:{
  	email: function(val){
  		this.userSites = [];
  		if (this.isEmailValid(val)) {
  			this.getUserSites(val);
  		}
  	}
  },

  mounted(){
  	console.log('sites mounted');
  }
});