<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembrosCelula extends Model
{
    
	protected $fillable = ['cpf','email','nome','endereco','celula_id'];
	//protected $guarded = [];
    //protected $celulas;
    //
    /**
     * Get the phone record associated with the user.
     */
    public function celula()
    {
        return $this->belongsTo('App\Celula');
    }
}

