<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

{
  protected $table = 'baixa_conta_pagar';
	public $timestamps = false;
	protected $fillable = array('data','valor_pago','valor_residual','fk_conta_pagar');
}
