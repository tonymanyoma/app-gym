<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_membresia extends Model
{

    public function estado_membresia(){
        return $this->hasMany(Mensualidad::class, 'id_estado_mensualidad');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "estados_membresia";

    /**
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion'
    ];
}
