<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{


    public function tipo_documento_usuario(){
        return $this->hasMany(Usuario::class, 'id_tipo_documento');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "tipo_documentos";

    /**
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion'
    ];
}
