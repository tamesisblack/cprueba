<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Factura;
use sisVentas\Cliente;
use sisVentas\Moneda;
use sisVentas\Uom;
use sisVentas\SalesPerson;
use sisVentas\TerminoPagoAR;
use sisVentas\Item;
use sisVentas\Impuesto;
use sisVentas\Entity;
use sisVentas\Recibo;
use sisVentas\FacturaDetalle;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use sisVentas\NumerosEnLetras;
use sisVentas\Site; 
use sisVentas\AppReceivablesTrxa;
use sisVentas\Promotion;
use sisVentas\PromotionAcumulate;
use sisVentas\SiteLabels; 
use Illuminate\Support\Facades\Session;
use DB;
use Laracasts\Flash\Flash;

class FacturaController extends Controller
{
        protected $currencies = [];
        protected $classes = [];
        protected $sellers = [];
        protected $terms = []; 
        protected $items = [];
        protected $uoms = [];
        protected $taxes = [];
        protected $enttityTax = 0;

    public function makeLists()
    {
        $this->currencies = ['' => 'Seleccione la moneda'] + Moneda::orderBy('descripcion', 'ASC')->get()->pluck('descripcion', 'idcurrency')->toArray();
        
        $this->classes =  ['' => 'Seleccione la clase', '1' => 'Factura' , '2' => 'Boleta' , '3' => 'Nota de crédito', '4'=> 'Nota de débito'];

        $this->sellers = ['' => 'Seleccione el vendedor'] + SalesPerson::orderBy('name', 'ASC')->get()->pluck('name', 'salesrep_id')->toArray();;

        $this->terms =  ['' => 'Seleccione el término de pago'] + TerminoPagoAR::orderBy('name', 'ASC')->get()->pluck('name', 'term_id')->toArray(); 
        
        $this->uoms = ['' => 'Seleccione el unidad de medida'] + Uom::orderBy('uom_code', 'ASC')->get()->pluck('uom_code', 'uom_code')->toArray();

        $this->taxes = ['' => 'Seleccione el impuesto'] + Impuesto::orderBy('name', 'ASC')->get()->pluck('name', 'tax_id')->toArray();

        $this->enttityTax = Entity::all()[0]['code_tax'];


        //JY  24.12.20
        $this->customers = ['' => 'Seleccione el Cliente'] + Cliente::orderBy('full_name', 'ASC')->get()->pluck('full_name', 'idcliente')->toArray();
    }

    public function savepayment(Request $request)
    {   
        $detail = $request->input('datax');
        $findreceipt_num = Recibo::where('receipt_number','=', $detail['numrecibo'] )->get();
        $countf = count($findreceipt_num);

            if($countf == 1)
            {
                return response()->json(['error' => 'ERROR']);
            }else{
                $savep = new Recibo();
 
                $mpago = $detail['mediopago'];
                $cus_trx_id = $detail['cus_trx_id'];  
                //return $fnd_pago;

                $savep->receipt_number = $detail['numrecibo'];
                $savep->type = 'standard';
                $savep->currency_code = $detail['moneda'];
                $savep->receipt_date = $detail['fechaabono'];
                $savep->amount = $detail['totaltrx'];
                $savep->comments = $detail['comments'];
                $savep->pay_from_customer = $detail['client_id'];
                $savep->confirmed_flag = 'N';
                $savep->receipt_method_id =  $detail['mediopago'];
                $savep->receipt_due_date = $detail['fechaabono'];
                $savep->deposit_date = $detail['fechaabono'];
                $savep->status = 'APP';
                $savep->last_updated_by = Auth::user()->id;
                $savep->created_by = Auth::user()->id;
                $savep->save();

                //if ($savep->save()) 

                 /*RELACIONA EL RECIBO CON LA FACTURA*/
                $appTrx = new AppReceivablesTrxa();
                $appTrx->amount_applied =  $detail['importerecibido'];
                $appTrx->amount_applied_from =  $savep->amount;
                $appTrx->gl_date =  date("Y-m-d") ;
                $appTrx->comments = 'Aplicacion de Recibo';
                $appTrx->display =  'Apply';
                $appTrx->apply_date =  date("Y-m-d") ;
                $appTrx->application_type = 'Payment';
                $appTrx->status =    'APP';
                $appTrx->cash_receipt_id = $savep->id;
                $appTrx->applied_customer_trx_id = $cus_trx_id;
                $appTrx->last_updated_by = Auth::user()->id;
                $appTrx->created_by = Auth::user()->id;

                $appTrx->save();
        
                $variable =  AppReceivablesTrxa::where('applied_customer_trx_id','=',  $cus_trx_id )->get();

                $t1 = 0 ;
                foreach ($variable as $p) 
                {
                    $t1 = $t1 + $p->amount_applied;
                }
                //dd( $savep->amount) ;
                 //dd( $t1 ) ;
                if ( $t1 < $savep->amount )
                    {
                     $t1 = 0 ;
                }
                else
                {    
                    //registrando los servicios que estan asociados a una promocion
                    $rsDet =  FacturaDetalle::where('customer_trx_id','=',  $cus_trx_id )->get();

                  // dd( $rsDet);
                    $id = 0 ;
                    foreach ($rsDet as $p) 
                    {   
                        $id = $p->item_id;
                         
                        $item_id = 0;
                        $rsPromo = Promotion::where('item_id', $id)->get();
                        $countP = count($rsPromo);
                        if( $countP == 0 ){ 
                          $item_id = 0;
                                        }
                        else
                            { 
                            
                            $item_id  = $rsPromo[0]->item_id; 
                           
                            $flag  = $rsPromo[0]->enabled; 
                            $promo_id  = $rsPromo[0]->id; 
                            $quantity_points  = $rsPromo[0]->equiv_points; 
                              
                            if($item_id > 0  && $flag == 1 )  {
                              //  dd($promo_id , $quantity_points);
                                $acumPrpmo = new PromotionAcumulate;
                                $acumPrpmo->customer_id =$detail['client_id'];
                                $acumPrpmo->promotion_id =$promo_id;
                                $acumPrpmo->product_id =$item_id;
                                $acumPrpmo->product_name = $p->description;
                                $acumPrpmo->quantity_points =$quantity_points;
                                $acumPrpmo->type_transaction = 'Billing';
                                $acumPrpmo->transaction_id =$cus_trx_id;
                                $acumPrpmo->transaction_date = date("Y-m-d") ;
                                $acumPrpmo->created_by =Auth()->user()->id;
                                $acumPrpmo->last_updated_by = Auth()->user()->id;
                         
                                $acumPrpmo->save();
                            }
                        } 
                    }

                    // dd( 'enter here' ) ;
                    $updateState = DB::table('cc_customer_trx_all')
                    ->where('customer_trx_id','=', $cus_trx_id  )
                    ->update(['status_trx' => 'CL' ]);

                    
                 }
                //$bills = Factura::orderby('customer_trx_id','desc')->get() ;   

                //  dd ( $bills->balance );   
                //return view('ventas.factura.index', compact('bills')) ;

                //Flash::success("Se ha registrado de manera exitosa!")->important();
                //   $request->session()->flash('alert-success', 'User was successful added!');

                //return redirect()->route('ventas.factura');

                //return redirect()->back()->with('success', 'Se ha cargado correctamente tu funcion'); 

  //return back()->withInput();
                return $savep;
               // return response()->json(['success' => 'success']);
            }


    }

    public function paymentinv($id)
    { 
        $main = Factura::find($id);
       // return $work;
        $fecha = date("Y-m-d H:m:s");
        $user = Auth::user()->name;
        $userid = Auth::user()->id;

        $subtotal1 = $main->opgravadas  - $main->Descuento;
        $tax_value = $main->tax_value;
        $tax = $subtotal1 * $tax_value ;

        $mediopago = DB::table('cc_pay_method')
                     ->where('condicion','=',1)
                     ->where('apply_liquidacion','=',1)
                     ->get();

        $moneda = Moneda::where('condicion','=',1)->get();


        $total = $subtotal1 +  $tax ;
        
        $nrTrx = $main->trx_number;

        return view('ventas.factura.payment', compact('nrTrx','moneda', 'mediopago', 'main','fecha','user','userid','total'));
    }
 
     public function applyreceipt()
    {
          //  $lists = Factura::select('trx_number','trx_date','term_due_date')->where('dayofcredit','!=', null)->get();
            
            // $lists = Factura::where('dayofcredit','!=', null)->get(); 2020.12.24

         $lists = Factura::get();
             
            return view('ventas.listaCredito.list', compact('lists'));
    }
    

    public function invoice_pdf($cust_trx_id)
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
        return \PDF::loadView('reportes.cotizacion-asesor.quotationStd.main', compact('d', 'details',  'labels','numlet'))->setpaper('a4')->stream();
         
    }

    public function listadoCredito()
    {
          //  $lists = Factura::select('trx_number','trx_date','term_due_date')->where('dayofcredit','!=', null)->get();
			
			// $lists = Factura::where('dayofcredit','!=', null)->get(); 2020.12.24

         $lists = Factura::get();
			 
            return view('ventas.listaCredito.list', compact('lists'));
    }

	//route:   ventas/factura
    public function index(Request $request)
    {
        $client = $request->client;

        $trxStart = $request->trxStart;
        
        $trxEnd = $request->trxEnd;

        $dateStart = $request->dateStart;
        
        $dateEnd = $request->dateEnd;


        /*$bills = Factura::id($request->trxStart, $request->trxEnd)
                ->idClient($client)
                ->client($client)
                ->idRange($request->trxStart, $request->trxEnd)
                ->dateRange($request->dateStart, $request->dateEnd)
                ->orderBy('customer_trx_id', 'DESC')
                ->paginate();
        */
         $bills = Factura::where('status_trx','<>','CANCEL')->orderby('customer_trx_id','desc')->get() ;   

       //  dd ( $bills->balance );   
        return view('ventas.factura.index', compact('bills', 'client', 'trxStart', 'trxEnd', 'dateStart', 'dateEnd'));
    }

    public function create()
    {
        $this->makeLists();

        $currencies = $this->currencies;
        $classes = $this->classes;
        $sellers = $this->sellers;
        $terms = $this->terms;
        $items = $this->items;
        $uoms = $this->uoms;
        $taxes = $this->taxes;
        $entityTax = $this->enttityTax;
        //JY  24.12.20
         $customers = $this->customers;

         $date = Carbon::now()->format('Y-m-d');

         $clientes = Cliente::orderBy('full_name', 'ASC')->where('effective_end_date', '>=', $date)->lists('full_name', 'idcliente');

       // dd($clientes);

        return view("ventas.factura.create", compact('currencies', 'classes', 'sellers', 'terms', 'items', 'uoms', 'taxes', 'entityTax',
            'clientes'));        
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'trx_number' => 'required|',
            'class_code' => 'required',
            'class_trx' => 'required|unique:cc_customer_trx_all',
            'trx_date' => 'required',
            'invoice_currency_code' => 'required',
            'bill_to_customer_id' => 'required',
            'ship_to_customer_id' => 'required',
        ]);
//dd($request->all());
        $bill = Factura::create($request->all());
        
        $bill->last_updated_by = Auth::user()->id;
        $bill->created_by = Auth::user()->id;
        
       // dd ( $bill ) ; 

        $bill->save();

        return redirect('/ventas/factura/' . $bill->customer_trx_id);
    }

    public function show(Request $request, $id)
    {
        $this->makeLists();
        
        $bill = Factura::find($id);
        $currencies = $this->currencies;
        $classes = $this->classes;
        $sellers = $this->sellers;
        $terms = $this->terms;
        $items = $this->items;
        $uoms = $this->uoms;  
        $taxes = $this->taxes;  
        $entityTax = $this->enttityTax;

$date = Carbon::now()->format('Y-m-d');

         $clientes = Cliente::orderBy('full_name', 'ASC')->where('effective_end_date', '>=', $date)->lists('full_name', 'idcliente');

        $billClient = Cliente::where('idcliente', $bill->bill_to_customer_id)->get();

        $billAddress = $billClient[0]->address;
        $shipAddress = $billClient[0]->address;

        $shipClient = Cliente::where('idcliente', $bill->ship_to_customer_id)->get();
        $shipAddress = $shipClient[0]->address;

        return view("ventas.factura.edit", compact('bill', 'billAddress', 'shipAddress', 'currencies', 'classes', 'sellers', 'terms', 'items', 'uoms', 'taxes', 'entityTax', 'clientes'));        
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'trx_number' => 'required',
            'class_code' => 'required',
            'trx_date' => 'required',
            'invoice_currency_code' => 'required',
            'bill_to_customer_id' => 'required',
            'ship_to_customer_id' => 'required',
        ]);

        $bill = Factura::find($id);
        $bill->fill($request->all());
        $bill->last_updated_by = Auth::user()->id;
        $bill->save();

       // return redirect('/ventas/factura');
    }

    public function delete($id)
    {
        $bill = Factura::find($id);
      return view('ventas.factura.delete', compact('bill'));  
    }
    
    public function destroy($id)
    {
        $details = FacturaDetalle::where('customer_trx_id', $id)->get();

        if ($details->count() > 0)
        {                
            foreach ($details as $detail) {
                $detail->delete();
            }
        }  
              
        Factura::destroy($id);

        return redirect()->route('ventas.factura.index');
    }

    public function cancel($id)
    {
        $bill = Factura::find($id);
        return view('ventas.factura.cancel', compact('bill'));  
    }

    public function setCancel($id)
    {
        $bill = Factura::find($id);

        $bill->status_trx = 'CANCEL';

        $bill->save();

        return redirect()->route('ventas.factura.index');
    }

}
