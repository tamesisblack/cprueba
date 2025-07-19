<?php

namespace sisVentas\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         //Commands\Inspire::class,
        //Commands\sendMail::class;
		
		//para revision de stock
		//Commands\NotifyProductStock::class;
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
		//REVISION DE CONTRATOS DE VEHICULOS
		$schedule->command('suc:sendmail')->daily();
		
		//para revision de stock
		$schedule->command('product:stock')->daily();

				/*
		$schedule->command('product:stock')
            ->dailyAt('12:00');

        $schedule->command('product:stock')
            ->dailyAt('00:00');
			*/
			
    }
}
