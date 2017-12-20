<?php

namespace projeto_laravel;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
  protected $table = 'caixa';
	public $timestamps = false;
	protected $fillable = array('data','valor','categoria','tipo','ref_titulo','user_id');

    public function user()
    {
        return $this->belongsTo('projeto_laravel\User');
    }
}
