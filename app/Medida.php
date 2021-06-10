<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{

    public function medida_usuario(){
        return $this->belongsTo(Usuario::class, 'id');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "medidas";

    /**
     * @var array
     */
    protected $fillable = [
        'fecha','peso','altura', 'imc' ,'id_cliente'
    ];
}
