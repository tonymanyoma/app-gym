<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    public function mensualidad_usuario(){
        return $this->belongsTo(Mensualidad::class, 'id');
    }

    public function id_estado_mensualidad(){
        return $this->belongsTo(Estado_mensualidad::class, 'id');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "plans";

    /**
     * @var array
     */
    protected $fillable = [
        'fecha','id_cliente','valor', 'id_estado_mensualidad' ,'id_trabajador'
    ];
}
