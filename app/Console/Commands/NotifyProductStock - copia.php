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
    {
        $items = DB::table('inv_item as art')
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

        Mail::send('emails.check-stock', ["data" => $items], function ($message) use($emailToSend) {
            $message->from(env('MAIL_FROM_ADDRESS', 'test@example.com'), 'Product Stock Alert');

            $message->to($emailToSend[0]->{'. email_whareouse_alert'});
        });

    }
}
