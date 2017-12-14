<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaixaContaReceberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('baixa_conta_receber', function (Blueprint $table) {
					$table->increments('id');
				 $table->date('data');
				 $table->float('valor_recebido');	    
				 $table->float('valor_residual');	
				 $table->integer('fk_conta_receber')->unsigned();
	 $table->integer('user_id');

   // $table->foreign('fk_conta_receber')->references('id')->on('conta_receber');
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('baixa_conta_receber');
    }
}
