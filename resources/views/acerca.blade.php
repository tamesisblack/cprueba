@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Acerca de...</h3>
	</div>
</div>

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<table>
		<tr><th>Desarrollado Por:</th><td>ASVNETS S.A.C</td></tr> 
		<tr><th>Email:</th><td>info@asvnets.com</td></tr>
		<tr><th>Whatsapp:</th><td>932 266 980</td></tr>
		<tr><th>Facebook:</th><td></td></tr>
		<tr><th>Sucursal:</th><td>{{Session::get('site_id') }} </td></tr> 
		<tr><th>Página web:</th><td><a href="www.asvnets.com" target="_blank">www.asvnets.com</a></td></tr>
		<tr><th>Otros proyectos:</th><td><a href="www.asvnets.com/p/tienda.html" target="_blank">www.asvnets.com/p/tienda.html</a></td></tr>
 	</table>
</div>
</div>
@endsection