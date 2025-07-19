<?php

namespace sisVentas\Http\Controllers;

use sisVentas\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use sisVentas\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexUser()
    {   
         
        return view('homeCustomer');
    }    
	
      public function dashPlanchado ()
    {
    
          return view('panel/panelPlanchado');
    } 

     public function dashboardCompras ()
    {
    
          return view('panel/panelCompras');
    }      

    public function dshInventory ()
    {
    
          return view('panel/panelInventory');
    }      
     
	 
    public function index()
    {   
        $uid = Auth()->user()->id ;
        $user = User::where('id',$uid)->get();
        $tuser = $user[0]->type ;
        //dd($tuser);
        if($tuser == 'Cliente')
        {
            return view('homeCustomer');
        }    
        else
        {
            $view = $user[0]->route_default ;
            if (!is_null($view))
                return view($view);

            $comprasmes = 0;

            $ventasmes = 0;


            $ventasdia = 0;

            $productosvendidos = 0;

            $totales = 0;
            setlocale(LC_TIME, 'es_ES');
            $bestSellers = DB::table('po_vendor')
                ->select(
                    'vendor_name',
                    DB::raw('COUNT(po_headers_all.po_header_id) AS CONTAR'),
                    DB::raw('ROUND(SUM(po_lines_all.unit_price * po_lines_all.quantity),2) AS TOTAL')
                )
                ->join('po_headers_all', 'po_vendor.vendor_id', '=', 'po_headers_all.vendor_id')
                ->join('po_lines_all', 'po_headers_all.po_header_id', '=', 'po_lines_all.po_header_id')
                ->where('po_headers_all.type_lookup_code', '=', 'STANDARD')
                ->where('po_headers_all.authorization_status', '=', 'APPROVED')
                ->groupBy('po_vendor.vendor_name')
                ->orderBy('total', 'DESC')
                ->take(10)
                ->get();


            $charts = DB::table('po_vendor')
                ->select(
                    'po_headers_all.created_at AS real',
                    //DB::raw("DATE_FORMAT(po_headers_all.created_at , '%M') AS MES"),
                    DB::raw('ROUND(SUM(po_lines_all.unit_price * po_lines_all.quantity),2) AS TOTAL'),
					DB::raw('YEAR(po_headers_all.created_at) year, MONTH(po_headers_all.created_at) mes')
                )
                ->join('po_headers_all', 'po_vendor.vendor_id', '=', 'po_headers_all.vendor_id')
                ->join('po_lines_all', 'po_headers_all.po_header_id', '=', 'po_lines_all.po_header_id')
                ->where('po_headers_all.type_lookup_code', '=', 'STANDARD')
                ->where('po_headers_all.authorization_status', '=', 'APPROVED')
				->whereYear('po_headers_all.created_at', '=', date('Y'))
                //->groupBy(DB::raw("DATE_FORMAT(po_headers_all.created_at,'%m')"))
				->groupBy('year','mes')
                ->get();
            $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $charts = collect($charts)->each(function ($item,$index)use($months) {
                $item->MES = $months[$index];
            });

            $data = [];
            foreach($charts as $index => $row) {

                $data['created_at'][] = $row->real;

                $data['data'][] = (int) $row->TOTAL;
            }
            $data['label'] = $months;
            $data['chart_data'] = json_encode($data);

            return view(
                'home',
                [
                    "comprasmes" => $comprasmes,
                    "ventasmes" => $ventasmes,
                    "ventasdia" => $ventasdia,
                    "productosvendidos" => $productosvendidos,
                    'bestSellers' => $bestSellers,
                    'charts' => $data,
                    'rows' => $charts
                ]
            );
        } 
            
    }
}
