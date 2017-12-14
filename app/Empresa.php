<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
     protected $table = 'empresa';
	public $timestamps = false;
	protected $fillable = array('nome_empresa','cidade','estado','saldo_inicial','data_inicial','user_id');
    
	public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
