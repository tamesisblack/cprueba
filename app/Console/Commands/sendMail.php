<?php

namespace sisVentas\Console\Commands;

use Illuminate\Console\Command;
use sisVentas\FsetupReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mail;
use sisVentas\WfNotifications;
 use Carbon\Carbon;
use Session;
use sisVentas\Site;
use DB;
use Illuminate\Support\Facades\Log;
use datetime ;


class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarea para enviar correo modulo vehiculo';

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
    {   /* ORIGINAL
        $processdata = DB::table('fnd_documents_expiration')
            ->join('fnd_lookup_value','fnd_lookup_value.idlvalue', '=','fnd_documents_expiration.document_id')
            ->join('vehiculo','vehiculo.id', '=','fnd_documents_expiration.object_id')
            ->where('fnd_documents_expiration.enabled','=', 1)
            ->select(DB::raw('vehiculo.placa as placa,fnd_lookup_value.code_value as documento , DATEDIFF(fnd_documents_expiration.date_to, CURRENT_DATE )  as dias_por_vencer'))
            ->get();
        */

        // APLICAR LOGICA PARA ENVIO DE CORREOS
        //$users = FsetupReminder::all();  //originalle 
        lOG::info( 'enviando correo');
        //$sid = Session::get('site_id');
        //lOG::info( 'site_id' . $sid );
        $users = FsetupReminder::where('module','=', 'Contratos')
                                ->where('enabled','=', 1)
                                ->where('site_id','=', 99 )
                                ->get();
        
        lOG::info( $users );
        $separador = ","; 
        $mi_cadena = $users[0]->cc; // $users[0]['cc'] ; // $users[0]->cc;
        //lOG::info( 'mi_cadena  ' .$mi_cadena );

        //$xxarray = explode($separador,$mi_cadena);                         
        //lOG::info( 'xxarray  ' .$xxarray );
            
        $dias =  $users[0]['due_days'] ;

         $processdata = DB::select("select c.placa, b.code_value as documento, a.date_from, a.date_to , a.enabled ,   DATEDIFF(a.date_to, CURRENT_DATE )  as dias_por_vencer
                        from fnd_documents_expiration as a
                        inner join fnd_lookup_value as b on b.idlvalue = a.document_id
                        inner join vehiculo as c on c.id = a.object_id 
                        WHERE a.enabled = 1 and DATEDIFF(a.date_to, CURRENT_DATE ) <=  $dias
                        Order by c.placa, date_to");

        LOG::info( $processdata );
       //  $processdata = $processdata::where ('dias_por_vencer','<=',10)
        //foreach ($processdata as $proces){
            //if($proces->dias_por_vencer > 0 && $proces->dias_por_vencer <= 7) {
        //    if( $proces->dias_por_vencer <= 7) {
                // dd($users);
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
                    \Mail::send('emails.confirmacion', $data, function ($m) use ($data, $user) {
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


            //}
        //}
    }
}
