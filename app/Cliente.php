<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     protected $table = 'clientes';
	public $timestamps = false;
	protected $fillable = array('nome',
	'tipoPessoa', 'documento','telefone','email','rua','numero','cidade','uf','cep');
}
