<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
{
     protected $table = 'clientes';
	public $timestamps = false;
	protected $fillable = array('credor');
	
}
