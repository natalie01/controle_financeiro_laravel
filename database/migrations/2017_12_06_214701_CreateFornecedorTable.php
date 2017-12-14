<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
						$table->string('nome');
					 $table->string('cpf/cnpj');
					$table->string('tipoPessoa');
					 $table->string('telefone');	    
					 $table->string('email')->nullable();
					 $table->string('rua');
					 $table->string('numero');
					 $table->string('cidade');
					 $table->string('uf');
					 $table->string('cep')->nullable();
	 				$table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
   {
        Schema::dropIfExists('fornecedores');
    }
}
