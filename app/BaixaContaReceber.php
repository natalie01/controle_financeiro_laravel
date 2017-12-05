<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class BaixaContaReceber extends Model
{
  protected $table = 'baixa_conta_receber';
	public $timestamps = false;
	protected $fillable = array('data','valor_recebido','valor_residual','fk_conta_receber');
}
