<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
  protected $table = 'caixa';
	public $timestamps = false;
	protected $fillable = array('data','valor','descricao','tipo','ref_titulo');
}
