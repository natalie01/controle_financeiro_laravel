<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
      protected $table = 'conta_receber';
	public $timestamps = false;
	protected $fillable = array('devedor',
	'datavencimento','dataemissao','valor_inicial','user_id','valor_recebido',
	'valor_residual');

    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
