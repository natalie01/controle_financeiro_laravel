<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaPagarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_pagar', function (Blueprint $table) {
					$table->increments('id');
					$table->string('credor');
				 $table->date('datavencimento');
				 $table->date('dataemissao');
				 $table->float('valor');	    
				 $table->string('recebido')->nullable();
	 			$table->integer('user_id');
				 $table->float('valor_residual');	
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('conta_pagar');
    }
}