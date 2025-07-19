<?php

namespace sisVentas\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use sisVentas\Factura;  
use sisVentas\SiteLabels; 
use sisVentas\Site; 
use sisVentas\NumerosEnLetras; 
use sisVentas\FacturaDetalle;  
//use sisVentas\Traits\ARReportesTrait;

trait ARReportesTrait 
{
  
    public function Globalinvoice_pdf($cust_trx_id)
    {


     //   dd($labels);
         $d = Factura::where('customer_trx_id',$cust_trx_id)->first();

         $site_id =  $d->site_id;
         //$site_id = Session::get('site_id');

         $labels = SiteLabels::where('site_id','=',$site_id)->first();
        
         $buscar_logo = Site::find($site_id );
        
         $moneda = $buscar_logo->desc_long_currency  != null ? $buscar_logo->desc_long_currency : 'Nada';


         $subtotal1 = $d->opgravadas  - $d->Descuento;
         $tax_value = $d->tax_value;
         $tax = $subtotal1 * $tax_value ;

         $subtotal2 = $subtotal1 +  $tax ;

         $numlet = NumerosEnLetras::convertir($subtotal2, $moneda, true);

        // dd ( $numlet);     
         $details = $d->detail; 
 
        //dd     ($d->cliente );    
        return \PDF::loadView('reportes.receivables.invoice.mainInvoice', compact('d', 'details',  'labels','numlet'))->setpaper('a4')->stream();
         
    }
 
	 
}
