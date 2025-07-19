    Vue.component('vue-datetimepicker', {
      // The todo-item component now accepts a
      // "prop", which is like a custom attribute.
      // This prop is called todo.
      data: function () {
        return {
          value: ''
        }
      },
      template: '#dttemplate',
      mounted: function () {
        var vm = this
        var mycomp = $(this.$el).datetimepicker({})
        //mycomp.datetimepicker('date', this.initDate)
        mycomp.on('dp.change', function (e) {
          vm.value = e.date
          vm.$emit('change', vm.value)
        })
      }    
    });

var app = new Vue({
  el: '#app',
  data(){
  	return{
	  	user: '',
	  	userName: '',	
	  	users: [],  	
	  	site: ''	,
	  	sites: [],  
	  	userSites:[],		
	  	test: '',	
	  	new_site: '',
		new_from: '',
		new_to: '',
		editing: false,
  	}
  },

  mounted(){
  	console.log('user-site mounted');
  	this.getUsers();
  	this.getSites();
  },

  methods:{
  	getUsers(){
  		var self = this;
  		axios.get('/userSite/user')
  			.then(function(response){
  				self.users = response.data;
  			})
  			.catch(function(error){
  				alert(error);
  			})
  	},

  	getSites(){
  		var self = this;
  		axios.get('/userSite/site')
  			.then(function(response){
  				console.log(response);
  				self.sites = response.data;
  			})
  			.catch(function(error){
  				alert(error);
  			})
  	},

  	add(){
        if (this.$refs['from'].value == '' || this.$refs['to'].value == '') {
          alert('Debe colocar un rango de fecha');
        }
        else{
  		var currentSite = this.getSite(this.new_site);
		this.userSites.push({
			IDUSUARIO: this.user,
			IDSITE: this.new_site,
			name: currentSite.name,
			description: currentSite.description,
			FEC_INI: this.$refs['from'].value,
			FEC_FIN: this.$refs['to'].value,
		});  		          
        }
  	},

  	remove(index){
  		this.userSites.splice(index, 1);
  	},

  	getSite(id){
  		for (var i = 0; i < this.sites.length; i++) {
  			if (this.sites[i].id == id) {
  				return this.sites[i];
  			}
  		}
  	},

  	getUser(id){
  		for (var i = 0; i < this.users.length; i++) {
  			if (this.users[i].id == id) {
  				return this.users[i];
  			}
  		}
  	},  	

  	store(){
  		if (this.editing) {
	  		axios.put('/seguridad/usersite/' + this.user, this.userSites)
	  			.then(function(response){
	  				alert(response.data.message);
	  			})
	  			.catch(function(error){
	  				alert(error);
	  			});
  		}
  		else{
	  		axios.post('/seguridad/usersite', this.userSites)
	  			.then(function(response){
	  				alert(response.data.message);
	  			})
	  			.catch(function(error){
	  				alert(error);
	  			});  			
  		}
  		this.clear();

  	},

  	getUserSites(){
  		var self = this
  		this.userSites = [];
		axios.get('/seguridad/usersite/' + this.user)
		.then(function(response){
			for (var i = 0; i < response.data.length; i++) {
				var currentSite = self.getSite(response.data[i].IDSITE);
				self.userSites.push({
					IDUSUARIO: self.user,
					IDSITE: response.data[i].IDSITE,
					name: currentSite.name,
					description: currentSite.description,
					FEC_INI: response.data[i].FEC_INI.substring(0, 10),
					FEC_FIN: response.data[i].FEC_FIN.substring(0, 10),
				});  						
			}		
			self.editing = response.data.length > 0;
		})
		.catch(function(error){
			alert(error);
		});  			

  	},

  	clear(){
  		this.new_site = '';
  		this.$refs['from'].value = '';
  		this.$refs['to'].value = '';
  	},

      canAdd(){
        return this.user != '' && this.new_site != '';
      },

  },

  watch: {
	user: function (val){
		this.userName = '';
		if (val != '') {
			this.getUserSites();
			this.userName = this.getUser(val).name;
		}      
	}

    },  


});