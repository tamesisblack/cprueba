<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Site;
use sisVentas\PoHeadersAll;
use sisVentas\Proveedor;
use sisVentas\PoLinesAll;
use sisVentas\Marca;
use sisVentas\Modelo;
use sisVentas\WorkOrder;
use sisVentas\EamWorkResourceAssigment;
use sisVentas\EamResource;
use sisVentas\Vehiculo;
use sisVentas\PartService;
use sisVentas\AsInventory;
use sisVentas\AsReceiptInventory;
use sisVentas\AsRecepcion;
use sisVentas\Cliente;
use sisVentas\SiteLabels;
use sisVentas\FndAttachedDocuments;
use sisVentas\Personal;
use sisVentas\AsEstimate;
 use sisVentas\AsEstimateItem;
 use sisVentas\FndLookup;
use sisVentas\FndLookupValue;
use sisVentas\NumerosEnLetras;
use Carbon\Carbon;
use DB;

class PdfController extends Controller
{   
    /*
        En icono imprimir
            <td>     
                <a href="recepcion/{{$lista->id}}" target="_blank">
                    <i class="fa fa-print" aria-hidden="true"></i>
                </a>
                 
            </td>
    */
  
    public function crearpdf($id)
    {   //usado para imprimir orden de compra
        //$site = Site::find(4);
        //$po_header = PoHeadersAll::where('site_id',$site->id)->get();
        $d = PoHeadersAll::find($id);
       
        //$site =  $po_header->sucursal;
        //$proveedor =   Proveedor::where('vendor_id',5)->first();

        $details = PoLinesAll::where('po_header_id', $id )->get();
        $tax =  $d->proveedorOrden->tax->tax_rate;
        $label_tax_code = $d->sucursal->label_tax_code;
        $valtax = 1;
        $codetax = 0 ;
        $porctax = 0 ;

        if ($tax > 0)
          {  
            $valtax = 1+ ($d->proveedorOrden->tax->tax_rate / 100) ;
            $codetax =  $d->proveedorOrden->tax->tax_rate;
            $porctax =  $d->proveedorOrden->tax->tax_rate / 100 ; 
         }
         
        //return $details;
         //dd ($currency );
        //return $po_header;
       // $view =  \View::make('pdf/index')->render();
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $nuevo="que pasa";
        return $pdf->loadView('reportes/ordencompra/index',compact('d','details','valtax',
                                'codetax','label_tax_code','porctax'))->stream('Historial.pdf');

        //return $pdf->loadView('reportes/ordencompra/index',compact('site','po_header','proveedor','details'))->stream('Historial.pdf');
         
    }
	
	public function crearpdf2022($id)
    {   //usado para imprimir orden de compra
        //$site = Site::find(4);
        //$po_header = PoHeadersAll::where('site_id',$site->id)->get();
        $d = PoHeadersAll::find($id);
       
        //$site =  $po_header->sucursal;
        //$proveedor =   Proveedor::where('vendor_id',5)->first();

        $details = PoLinesAll::where('po_header_id', $id )->get();
        $tax =  $d->proveedorOrden->tax->tax_rate;
        $currency = $d->sucursal->label_tax_code;
        $valtax = 1;
        $codetax = 0 ;
        $porctax = 0 ;

        if ($tax > 0)
          {  
            $valtax = 1+ ($d->proveedorOrden->tax->tax_rate / 100) ;
            $codetax =  $d->proveedorOrden->tax->tax_rate;
            $porctax =  $d->proveedorOrden->tax->tax_rate / 100 ; 
         }
          
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $nuevo="que pasa";
        return $pdf->loadView('reportes/ordencompra/repStd2022',compact('d','details','valtax',
                                'codetax','currency','porctax'))->stream('Historial.pdf');

        //return $pdf->loadView('reportes/ordencompra/index',compact('site','po_header','proveedor','details'))->stream('Historial.pdf');
         
    }
 
}
