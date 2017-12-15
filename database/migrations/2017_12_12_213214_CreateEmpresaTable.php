<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
						$table->string('nome_empresa');
					 $table->string('cidade');
					 $table->string('estado');
					 $table->float('saldo_inicial')->nullable();
					 $table->float('saldo_atual')->nullable();
					 $table->date('data_inicial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
   {
        Schema::dropIfExists('empresa');
    }
}
