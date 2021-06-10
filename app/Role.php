<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function role_usuario(){
        return $this->hasMany(Usuario::class, 'id_role');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "roles";

    /**
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion'
    ];
}
