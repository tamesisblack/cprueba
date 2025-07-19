<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\Factura;
use sisVentas\FacturaDetalle;
use Illuminate\Support\Facades\Auth;

class FacturaDetalleController extends Controller
{
    public function store(Request $request){


            $bill = $request->all()['0']['customer_trx_id'];

            $details = FacturaDetalle::where('customer_trx_id', $bill)                
                ->get();

            if ($details->count() > 0)
            {                
                foreach ($details as $detail) {
                    $detail->delete();
                }
            }

    	foreach ($request->except('_token') as $item) {
    	   $detail = FacturaDetalle::create($item);

                $detail['last_updated_by'] = Auth::user()->id;
                $detail['created_by'] = Auth::user()->id;
                $detail->save();
    	}

    	return response()->json([
                 'title' => 'Detalle de factura',
                 'message' => 'El detalle de la factura ha sido creado'
       ]);
    }

public function index($id)
    {   // dd($id);
	 $details = FacturaDetalle::orderBy('line_number', 'DESC')->get();

        return view('sales.details_list',[
            'data' => $details
        ]);      
    }
	
    //route:    sales/details
    public function list2()
    {
        $details = FacturaDetalle::orderBy('line_number', 'DESC')->get();

        return view('sales.details_list',[
            'data' => $details
        ]);      
    }

    public function show($id)
    {
    	$details = FacturaDetalle::where('customer_trx_id', $id)
                ->with('item')
                ->orderBy('line_number', 'DESC')
                ->get()
                ->all();

    	return $details;    	
    }
}
