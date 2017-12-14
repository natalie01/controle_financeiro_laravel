<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
     protected $table = 'conta_pagar';
	public $timestamps = false;
	protected $fillable = array('credor','datavencimento','dataemissao','valor','user_id','valor_residual');

    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }	
}
