<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    public function estado_usuario(){
        return $this->hasMany(Usuario::class, 'id_estado');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "estados";

    /**
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion'
    ];
}
