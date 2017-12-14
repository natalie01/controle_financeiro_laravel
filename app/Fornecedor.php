<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    //
     protected $table = 'fornecedores';
	public $timestamps = false;
	protected $fillable = array('nome',
	'tipoPessoa', 'documento','telefone','email','rua','numero','cidade','uf','cep','user_id');

    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
