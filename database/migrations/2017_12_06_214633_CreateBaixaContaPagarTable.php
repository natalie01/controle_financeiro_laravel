<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaixaContaPagarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baixa_conta_pagar', function (Blueprint $table) {
					$table->increments('id');
				 $table->date('data');
				 $table->float('valor_pago');	    
				 $table->float('valor_residual');	
				 $table->integer('fk_conta_pagar')->unsigned();
	 $table->integer('user_id');
    //$table->foreign('user_id')->references('id')->on('users');
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('baixa_conta_pagar');
    }
}
