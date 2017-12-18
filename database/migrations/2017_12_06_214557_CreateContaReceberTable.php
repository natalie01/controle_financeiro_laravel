<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_receber', function (Blueprint $table) {
					$table->increments('id');
					$table->int('num_titulo');
					$table->string('devedor');
				 $table->date('datavencimento');
				 $table->date('dataemissao');
				 $table->float('valor_inicial');	    
				 $table->string('status')->nullable();
	 			$table->integer('user_id');
				 $table->float('valor_recebido');	
				 $table->float('valor_residual');	 
					$table->boolean('parcelado');
				$table->int('num_parcela');
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('conta_receber');
    }
}
