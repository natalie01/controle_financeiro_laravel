<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class DespesasFixas extends Model
{
      protected $table = 'despesas_fixas';
	public $timestamps = false;
	protected $fillable = array('descricao','categoria','valor','user_id');

    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
