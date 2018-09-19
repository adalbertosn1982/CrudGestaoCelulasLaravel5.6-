<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celula extends Model
{
    //
    protected $fillable = ['codigo','nome','endereco','ativa'];

    public function membrosCelula()
    {
        return $this->hasMany('App\MembrosCelula');
    }
    /*
    public function cidade() {
    	return $this->belongsTo('App\Cidade');
    }*/
}
