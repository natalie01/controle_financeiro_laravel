<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
      protected $table = 'conta_receber';
	public $timestamps = false;
	protected $fillable = array('num_titulo','devedor',
	'datavencimento','dataemissao','valor_inicial','status','user_id','valor_recebido','valor_residual','parcelado','num_parcela');


    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
