<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa');
            $table->integer('idmarca')->unsigned();
            $table->integer('idmodelo')->unsigned();
            $table->date('año');
            $table->string('color');
            $table->boolean('combustion_gas')->default('0');
            $table->boolean('combustion_glp')->default('0');
            $table->boolean('combustion_gnv')->default('0');
            $table->boolean('combustion_petroleo')->default('0');
            $table->string('num_motor');
            $table->integer('km');
            $table->date('proxima_visita');
            $table->boolean('no_atender')->default('0');
            $table->integer('idcliente')->unsigned();
            $table->text('motivo_no_atencion')->nullable();
            $table->integer('last_updated_by')->unsigned();
            $table->integer('created_by')->unsigned();

            $table->foreign('idmarca')->references('idmarca')->on('marca');
            $table->foreign('idmodelo')->references('idmodelo')->on('modelo');
            $table->foreign('idcliente')->references('idcliente')->on('cliente');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('last_updated_by')->references('id')->on('users');

            $table->timestamps();
        });
    }

     
}
