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
					$table->string('devedor');
				 $table->date('datavencimento');
				 $table->date('dataemissao');
				 $table->float('valor');	    
				 $table->string('recebido')->nullable();
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
