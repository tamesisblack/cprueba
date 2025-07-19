<?php

namespace sisVentas\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;

class NotifyProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Product Stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {	/*
		//count sites actives
		$s = Site::where('condicion','1')->count();
		
		//seleccionando destinatarios
		lOG::info( 'step for-email');
		if ($s > 1)
		{ 
			$sid = Session::get('site_id');
			//lOG::info( 'site_id' . $sid );
			$users = FsetupReminder::where('module','=', 'INV_MINMAX')
									->where('enabled','=', 1)
									->where('site_id','=', $sid )
									->get();
        }
		else
		{ 
			$vSite = Site::where('condicion','1')->get();
			$sid = $vSite->id;
			//lOG::info( 'site_id' . $sid );
			$users = FsetupReminder::where('module','=', 'INV_MINMAX')
									->where('enabled','=', 1)
									->where('site_id','=', $sid )
									->get();
        }
			
        lOG::info( $users );
		*/
		$users = FsetupReminder::where('module','=', 'INV_MINMAX')
									->where('enabled','=', 1)
									->where('site_id','=', 99 )
									->get();
									
        $processdata = DB::table('inv_item as art')
            ->join('inv_onhand_quantities_detail as di','art.inv_item_id','=','di.item_id')
            ->select(DB::raw('CONCAT(art.nombre , " ", IFNULL(art.qb_upc_ean, " ")
            ) AS articulo'),'art.inv_item_id as idarticulo','di.primary_transaction_quantity as stock', 'art.list_price_per_unit as precio_promedio','art.nombre',
                'art.list_price_per_unit as prec_venta' ,'art.qb_upc_ean as cod_barra', 'art.primary_uom_code', 'art.min_minmax_quantity', 'art.max_minmax_quantity')
            ->where('art.inventory_item_status_code','=','Active')
            ->where('di.primary_transaction_quantity','>','0')
            ->where(DB::raw('CAST(di.primary_transaction_quantity AS DECIMAL(10,2))'), '<=', DB::raw('CAST(art.min_minmax_quantity AS DECIMAL(10,2))'))
            ->orderBy('art.nombre')
            ->get();


        $emailToSend = DB::table('inv_sites')->limit(1)->get();
 
		foreach ($users as $user)
		{
			$to_name = 'TO_NAME';
			$to_email = $user->mailto;
			// $data = array('name'=>"Sam Jose", "body" => "Test mail");
		 //   var_dump(trim($user->mailto));
			$data = array(
				'from' => env('MAIL_FROM_ADDRESS'),
				'to' => $user->mailto,
				'subject' => $user->subject,
				'messagenote' => $user->message,
				'name' => 'USUARIO',
				'infomail' => $processdata
			);
//                    var_dump(env('MAIL_FROM_NAME'));

			//$data = $user->message;
			LOG::info("DEBERIA ENVIAR....");
			\Mail::send('emails.check-stock', $data, function ($m) use ($data, $user) {
				// var_dump($data);
				$m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
				$m->to(trim($user->mailto), 'usuario')->subject($data['subject']);

			}) ;

			$date = Carbon::now()->format('Y-m-d');

			$notif = new WfNotifications();
			$notif->message_type = 'WFMAIL';
			$notif->message_name = 'SENT_MAIL_TO';
			$notif->recipient_role =  $user->mailto;
			$notif->status = 'OPEN';
			$notif->mail_status = 'SENT';
			$notif->begin_date =  $date;
			$notif->from_user = 'notificaciones';
			$notif->to_user =  'USUARIO';
			$notif->subject =  $user->subject;
			$notif->save();
		}
    }
}
