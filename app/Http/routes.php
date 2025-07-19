<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('sendmail1', function(){
    print_r('ejecutando');
   Artisan::call('command:sendmail');
 
});
*/

// borrar caché de la aplicación
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Optimization completed.';
});

// borrar caché de configuración
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// borrar caché de vista
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});

Route::get('sendmail', function(){
    //print_r('ejecutando');
    try{
        $enviomail = \Artisan::call('command:sendmail');
        return response()->json(['status' => 1, 'data' => $enviomail ]);
    }
    catch(\Exception $e)
        {
        return response()->json(['status' => 0, 'data' => $e ]);
        }
});

Route::get('/', function () {
    //return view('auth/login');
    return view('login2021');
});
Route::get('/acerca', function () {
    return view('acerca');
});


 //MASTER Item
	Route::get('item/master', 'ItemController@index')->name('item/master');
	 
 
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


//CAMBIO D ESUCURSAL

Route::get('/ajax/update-session/{id}', function($id){
     return Session::put('site_id',$id);
});


// PARAMETROS  DE SUCURSAL

Route::resource('configuracion/site','SiteController');

 Route::resource('compras/orden', 'OrdenController');

 // borrar caché de ruta
 Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});
 
Route::get('url/{id}','UsuarioController@changepwd')->name('user.change.password');
//Route::get('seguridad/pwd/{id}/','UsuarioController@changepwd');
  
// ---- fin modulo reporte

//<I>zone routes includes /

//<F> zone routes includes
 
  
Route::get('compras/printOrder/{order}', 'PdfController@crearpdf');
Route::get('compras/printOrder22/{order}', 'PdfController@crearpdf2022');
Route::get('printInvoice/{id}','SalesController@printInvoice')->name('printInvoice');
Route::get('items/master', 'ItemController@index')->name('items.master');            
Route::auth();

  
  	Route::group(['prefix' => 'almacen'], function () {
		Route::resource('item', 'ItemController');
		//Route::post('/item/items',  function(){return 'hola';
		Route::post('/item/items','ItemController@cat_item' ) ;
		
	});

// organizacion

Route::get('/home', 'HomeController@index');
    
Route::get('/list/finallylabor','WorkOrderReceiptController@finallylabor')->name('finallylabor');

//Reportes  
//CREACION AUTOMATICA DE ORDEN DE TRABAJO
 
 Route::get('/print/adelanto/{id}','WorkOrderFinancialController@imprimir')->name('imprimir_adelanto');

Route::get('invoice_cc/{cust_trx_id}/pdf', 'FacturaController@invoice_pdf')->name('invoice_cc');

 Route::resource('ot/receipt','WorkOrderReceiptController');	
 
	Route::get('fact/detalle',  'FacturaDetalleController@list2')->name('fact.detalle');
  
  Route::group(['prefix' => 'ventas'], function()
{
    //Facturas
    Route::resource('factura', 'FacturaController');  //route:	ventas/factura
	
});	
 
 