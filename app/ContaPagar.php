<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
     protected $table = 'conta_pagar';
	public $timestamps = false;
	protected $fillable = array('credor','datavencimento','dataemissao','valor'););
	
}
