  <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISCAD 2.0 | </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token / Fernando-->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <!-- Datepicker O.Leon -->
    <link rel="stylesheet" href="{{asset('css/jquery-ui-1.10.4.custom.min.css')}}">


    <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="{{asset('css/datepicker3.css')}}" >

      <!-- Facturas - Recibos / CC -->
      <link rel="stylesheet" href="{{asset('css/bills.css')}}" >

      <!-- Creacion Automatica / Agrega Materiales-->
  <link rel="stylesheet"  href="{{asset('AdminLTE/sweetalert2.min.css')}}">

 <!-- DataTables -->
  <link rel="stylesheet"  href="{{asset('AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">

  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
  
<!-- fixed columns-->
 <!-- COMMENT  14.04.20 -- JY
  <script src="https://cdn.datatables.net/fixedcolumns/2.0.3/js/FixedColumns.min.js"></script>
-->

  <!-- FullCalendar / Creacion de citas-->
    <link href="{{ asset('fullcalendar/main.css') }}" rel='stylesheet' /><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- RAFAEL TORREALBA - VEN -->
<link href="{{ asset ('AdminLTE/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset ('AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset ('AdminLTE/plugins/datepicker/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset ('AdminLTE/plugins/datepicker/bootstrap-datepicker.standalone.css') }}" rel="stylesheet" type="text/css">

   <link rel="stylesheet" href="{{ asset ('chosen/chosen.css') }}">

   <link rel="stylesheet" href="{{ asset ('css/font-color.css') }}">

   @yield('header_styles')
<!-- /. RAFAEL TORREALBA - VEN -->

  <!-- YASSER  -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

<!-- Actualización Asignación-->
<script src="{{ asset('js/moment-with-locales.js')}}"></script>

<!-- cotizaciones/fernando-->
 
{{--ICHECK--}}
  <link href="{{ asset ('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css">
 <!-- FIN cotizaciones  --> 


<!-- seguridad/ user site -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css"> 
<!-- user site -->

<!-- leave vehicle -->
  @yield('css')
<!-- END leave vehicle -->

<!-- configuracion correo -->
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css')}}">

<!-- PANTALLA DE VENTAS2 -->

<!--JQUERY UI CSS-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--JQUERY UI CSS-->


<!--TOASTR-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!--TOASTR-->

<!--TOASTR CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!--TOASTR CSS-->

 <!--I_load images from delivery-->
<link href="{{ asset ('css/image-uploader.min.css') }}" rel="stylesheet" type="text/css">
<!--F_load images from delivery-->

  </head>
  

<!-- para pintar las filas con execo de adelanto -->  
<!-- simple way of sizing columns such that all each row 
    Date Implemented : JY-2020.0.08
https://datatables.net/forums/discussion/17475/single-line-per-row?fbclid=IwAR1HszSkeD77zalxprQaW94DpgvUlnZc7ae1ei4TdXY78X3Db872Xo5A7cQ

    table.dataTable td {
      padding: 3px 10px;
      width: 100px;
      white-space: nowrap;
      }
--> 
  <style>
          
      .red {
        background:#eafaea;
        font color="red";

      }


      table.dataTable td {
      padding: 3px 10px;
      width: 100px;
      white-space: nowrap;
      }
    
      .white {

      } 

       
    </style>
     
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('home')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SISCAD</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SISCAD</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  Fecha Local : {{ Carbon\Carbon::now()->format('d-m-Y') }}  / 
                  <small class="bg-red">Online</small>
                  <!--<span class="hidden-xs">{{ Auth::user()->name }}</span> -->
                  <span class="hidden-xs">{{ Auth::user()->name }} <strong class="bg-green">{{Session::get('site_id') == null ? '' : 'Empresa: ' . \sisVentas\Site::find(Session::get('site_id'))->name}}</strong></span>
                  
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                      www.asvnets.com <br>SISTEMA GESTION ADMINISTRATIVO
                       
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                    <div class="pull-left">
                       
				            </div>
						
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                     
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

            
		
		 
			  <li id="lismItems"><a href="{{url('items/master')}}"><i class="fa fa-circle-o"></i> Maestro de Articulos  </a></li>
			   <li><a href="{{url('configuracion/site')}}"><i class="fa fa-circle-o"></i> Sucursales</a></li>
		 
            <li>
              <a href="{{url('acerca')}}">
                <i class="fa fa-info-circle"></i> <span>Ayuda...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>

             <li id="liUsuarios">
                
                <a href="{{ route('user.change.password', Auth::user()->id ) }}">
                  <i class="fa fa-circle-o"></i> Cambiar Clave
                  <small class="label pull-right bg-yellow">IT</small>
                </a>
             </li>
 
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
			<!--INICIO CUSTOM: FIXED COLUMNS 20200604-->
              <style type="text/css">
			   div.dataTables_wrapper {
            width: 1000px;
        }
			  .fixed-col {
				  position: sticky !important;
				  background-color: white !important;
			
				  width: auto !important;
				  min-width: 100px !important;
				  max-width: auto !important;
				  left: 0px !important;
    
				  z-index: 1;
				}
			</style>
			<!--FIN CUSTOM: FIXED COLUMNS 20200604-->
          <div class="row">
            <div class="col-md-12 hidden-print">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de Gestion Administrativo</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12" id="app">
		                          <!--Contenido-->
									@yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            <div class="visible-print-block">
              @yield('print')
            </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer hidden-print">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2016-2020 <a href="www.asvnets.com">ASVNETS.COM</a>.</strong> All rights reserved.
      </footer>
	   

      
    <!-- jQuery 2.1.4 -->
    <!--
     old 02.05.17 <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script> 
     -->
     <!-- NUEVO 02.05.17  -->
     <script src="{{asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
      <!--/ NUEVO -->
    @stack('scripts')

    <!-- Load images -->
    <script src="{{asset('js/image-uploader.min.js')}}"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
    <!-- Datepicker O.Leon -->
    <script  type="text/javascript" src="{{asset('js/jquery-ui-1.10.4.custom.min.js')}}"></script>            
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>    

    <!-- DataTables App 
    <script type="text/javascript" charset="utf8" src="{{asset('js/datatables/jquery.dataTables.js')}}"></script>
-->

<!-- RAFAEL TORREALBA - VEN. -->
  <!-- SlimScroll -->

  <script src="{{ asset('chosen/chosen.jquery.js') }} "></script>

  
  <script src="{{asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <!-- AdminLTE plugins-->

  <script src="{{asset('AdminLTE/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.es.js')}}"></script>

  <script type="text/javascript" src="{{ asset('AdminLTE/plugins/datatables/datatables.min.js') }}"></script>

   <!-- fixed columns -->
 
 <!--JQUERY UI-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--JQUERY UI-->

   <!--RESPONSIVE COLUMNS-->

   <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<!--RESPONSIVE COLUMNS-->


  <script type="text/javascript" src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script type="text/javascript" src="{{ asset('AdminLTE/plugins/input-mask/jquery.inputmask.phone.extensions.js') }}"></script>
<script type="text/javascript" src="{{ asset('AdminLTE/plugins/select2/select2.min.js') }}"></script>
<!-- / RAFAEL TORREALBA - VEN. -->

<!-- / creacion automatica -->
<script src="/AdminLTE/sweetalert2.min.js"></script>
<!-- / FIN creacion automatica -->

<!-- / cotizaciones -->
<script src="{{asset('plugins/iCheck/icheck.js')}}"></script>
<!-- FIN cotizaciones -->


<!-- / Despacho Materiales OT    -->
<!--PROD  <script type="text/javascript" src="{{asset('js/dispatch_material.js')}}"></script>
-->
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>													  

<script type="text/javascript" src="{{asset('js/return_material.js')}}"></script>
 <!-- FIN / Despacho Materiales OT  -->

<!-- / Facturas/ Recibos  AR -->
{{-- Vue.js --}}
    <script src="{{asset('js/vue.js')}}"></script>
    {{-- <script src="https://unpkg.com/vue"></script> --}}   
    <script src="{{asset('js/axios.js')}}"></script>
    <script src="{{asset('js/numeral.js')}}"></script>
    <script src="{{asset('js/vue-select.js')}}"></script>  
<!-- FIN Facturas/ Recibos -->

<!-- / DATATABLES - EXPORTAR -->
<!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- FullCalendar / Crear citas-->
    <script src="{{ asset('fullcalendar/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/locales/es.js') }}"></script>
    <script src="{{ asset('fullcalendar/locales-all.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/select2/select2.full.min.js') }}"></script>
    
	
<script type="text/javascript">
	//----<I> 20230923 Miguel Mex - Form planchado
	$(document).ready(function () {
    $('.select2').select2();

     $('#marca').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/vehiculo/marca") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });

     $('#modelo').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/vehiculo/modelo") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                          marca: $('#marca').val()
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });

       $('#nro_inventario').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/vehiculo/numsiniestros") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                          cliente: $('#id_cliente').val(),
                          vehiculo: $('#id_vehiculo').val()
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });
       //----Ubigeo----------------------
       $('#departamento').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/clasificacion/categoria/ajax") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                          categoria: 'Departament'
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });
        $('#provincia').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/clasificacion/categoria/ajax") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                          categoria: 'Provincia',
                          departamento: $('#departamento').val()
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });

      $('#distrito').select2({
          ajax: {
              dataType: 'json',
              url: '{{ url("planchado/clasificacion/categoria/ajax") }}',
              delay: 250,
              //minimumInputLength: 3,
              data: function(param) {
                      //let q = param.term.toLowerCase()
                      var query = {
                          search: param.term,
                          categoria: 'Distrito',
                          departamento: $('#departamento').val(),
                          provincioa: $('#provincia').val()
                      }
                  console.log('query :', query)
                  return query;
              },
              processResults: function (data, page) {
                return {
                    results: data
                };
              },
              theme: "classic"
          }
      });
  });

  function limpiar_prm_vehiculo(){
      $('#placa').val('');
      $('#marca').val('');
      $('#modelo').val('');
      $('#anio').val('');
      $('#color').val('');
      $('#tipo').val('');
      $('#uso').val('');
      $('#num_motor').val('');
      $('#num_chasis').val('');
  }

   function save_vehiculo(){
      var prm_placa = $('#placa').val();
      var prm_marca = $('#marca').val();
      var prm_modelo = $('#modelo').val();
      var prm_anio = $('#anio').val();
      var prm_color = $('#color').val();
      var prm_tipo = $('#tipo').val();
      var prm_uso = $('#uso').val();
      var prm_num_motor = $('#num_motor').val();
      var prm_num_chasis = $('#num_chasis').val();

      $.ajax({
        type: "post",
        url: "{{asset('').'planchado/vehiculo/store'}}",
        data: { "_token": "{{ csrf_token() }}", placa: prm_placa, marca: prm_marca, modelo: prm_modelo, anio: prm_anio, color: prm_color, tipo: prm_tipo, uso: prm_uso, num_motor:  prm_num_motor, num_chasis: prm_num_chasis},
        success: function (res) {
          
            if(res.success){
              document.getElementById("id_vehiculo").options[document.getElementById("id_vehiculo").options.length]=new Option(res.data.placa,res.data.id);
              
              $('#modal-vehiculo').modal('hide');
              limpiar_prm_vehiculo();

              Swal.fire({
                icon: 'success',
                title: 'Alerta',
                text: 'Vehiculo registrado con éxito.',
              });

              $('#id_vehiculo').val(res.data.id).change();
            }
        },
        dataType: "json"
      });
   }
   function limpiar_cliente(){
      $('#nombres').val('');
      $('#sexo').val('');
      $('#apaterno').val('');
      $('#f_nacimiento').val('');
      $('#amaterno').val('');
      $('#tipo_documento').val('');
      $('#num_documento').val('');
      $('#razon_social').val('');
      $('#nombre_contacto').val('');
      $('#num_ruc').val('');
      $('#correo').val('');
      $('#telefono_1').val('');
      $('#telefono_2').val('');
      $('#departamento').val('');
      $('#provincia').val('');
      $('#distrito').val('');
   }

   function save_cliente(){
    var prm_tipo_persona = $("input[type=radio][name=tipo_persona]:checked").val();

    var prm_nombres = $('#nombres').val();
    var prm_sexo = $('#sexo').val();
    var prm_apaterno = $('#apaterno').val();
    var prm_f_nacimiento = $('#f_nacimiento').val();
    var prm_amaterno = $('#amaterno').val();
    var prm_tipo_documento = $('#tipo_documento').val();
    var prm_num_documento = $('#num_documento').val();
    var prm_razon_social = $('#razon_social').val();
    var prm_nombre_contacto = $('#nombre_contacto').val();
    var prm_num_ruc = $('#num_ruc').val();
    var prm_correo = $('#correo').val();
    var prm_telefono_1 = $('#telefono_1').val();
    var prm_telefono_2 = $('#telefono_2').val();
    var prm_departamento = $('#departamento').val();
    var prm_provincia = $('#provincia').val();
    var prm_distrito = $('#distrito').val();

    $.ajax({
        type: "post",
        url: "{{asset('').'planchado/cliente/store'}}",
        data: { "_token": "{{ csrf_token() }}", tipo_persona: prm_tipo_persona, nombres: prm_nombres, sexo: prm_sexo, paterno: prm_apaterno, f_nacimiento: prm_f_nacimiento, materno: prm_amaterno, tipo_documento: prm_tipo_documento, num_documento: prm_num_documento, razon_social: prm_razon_social, nombre_contacto:  prm_nombre_contacto, num_rec: prm_num_ruc, correo: prm_correo, telefono1: prm_telefono_1, telefono2: prm_telefono_2, departamento: prm_departamento, provincia: prm_provincia, distrito: prm_distrito},
        success: function (res) {
            console.log(res);
            if(res.success){
              document.getElementById("id_cliente").options[document.getElementById("id_cliente").options.length]=new Option(res.data.name,res.data.id);
              
              $('#modal-cliente').modal('hide');
              limpiar_cliente();

              Swal.fire({
                icon: 'success',
                title: 'Alerta',
                text: 'Cliente registrado con éxito.',
              });

              $('#id_cliente').val(res.data.id).change();
            }
        },
        dataType: "json"
      });

   }
   
	function tipo_p(tipo_p){
		var prm_natural = document.getElementById('natural');
		var prm_juridica = document.getElementById('juridica');
		if(tipo_p == 'natural'){
			prm_natural.style.display = 'block';
			prm_juridica.style.display = 'none';
		}else if(tipo_p == 'juridica'){
			prm_natural.style.display = 'none';
			prm_juridica.style.display = 'block';
		}
	}
	//----<F> 20230923 Miguel Mex - Form planchado
	
  function showModalSucursal(){
    console.log('cambio');
    $('#modalSucursal').modal('show');
  }
  function hideModalSucursal(){
    $('#modalSucursal').modal('hide');
  }
  function cambioSucursal(id,name){
    $.get( "/ajax/update-session/"+id);
    location.reload();
  }

</script>
@yield('js')



<script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.js')}}"></script>


  </body>
</html>
