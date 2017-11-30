<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('nome');
	 $table->string('tipoPessoa');
	 $table->string('cpf/cnpj');
	 $table->string('telefone');	    
	 $table->string('email')->nullable();
	 $table->string('rua');
	 $table->string('numero');
	 $table->string('cidade');
	 $table->string('uf');
	 $table->string('cep')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
   {
        Schema::dropIfExists('clientes');
    }
}
