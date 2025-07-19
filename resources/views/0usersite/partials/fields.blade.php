<div  class="col-md-12">


<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Usuario</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
	<div class="form-group col-md-6">
		<label for="user">Usuario</label>
		<select class="form-control" v-model="user">
			<option selected value="">Seleccione un usuario</option>
			<option v-for="user in users" :value="user.id">@{{user.email}}</option>
		</select>
	</div>	

	<div class="form-group col-md-6">
		<label for="user">Persona</label>
		<input type="text" v-model="userName" readonly class="form-control">
	</div>
  </div>
</div>

<div class="box box-solid box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Sucursales</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
	<div class="form-group col-md-5">
		<label for="site">Sucursal</label>
		<select class="form-control" v-model="new_site">
			<option selected value="">Seleccione una sucursal</option>
			<option v-for="site in sites" :value="site.id">@{{site.name}}</option>
		</select>
	</div>		
	<div class="form-group col-md-3">
		<label>Desde</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		      		<input type="text" ref="from" class="form-control datepicker">
		      </div>		

	</div>
	<div class="form-group col-md-3">
		<label>Hasta</label>
		      <div class="input-group date">
		        <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		        </div>
		      		<input type="text" ref="to" class="form-control datepicker">
		      </div>		


	</div>	

	<div class="form-group col-md-1">
		<label>Agregar</label> <br>
		<button class="btn btn-success" @click.prevent="add()" :disabled="!canAdd()"><i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>

  </div>
</div>

<div class="box box-solid box-primary" v-if="userSites.length > 0">
  <div class="box-header with-border">
    <h3 class="box-title">Sucursales asociadas a @{{userName}}</h3>
    <div class="box-tools pull-right">
    </div>
  </div>
  <div class="box-body">
	<table class="table">
		<tr>
			<th>NOM. SUCURSAL</th>
			<th>DES. SUCURSAL</th>
			<th>FECHA INICIO</th>
			<th>FECHA FIN</th>
			<th>Acciones</th>
		</tr>
		<tr v-for="(userSite, index) in userSites">
			<td>@{{userSite.name}}</td>
			<td>@{{userSite.description}}</td>
			<td>@{{userSite.FEC_INI}}</td>
			<td>@{{userSite.FEC_FIN}}</td>
			<td><button class="btn btn-danger" @click="remove(index)"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
		</tr>

	</table>
  </div>
</div>






</div>
