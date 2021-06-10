<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{

    public function id_estado(){
        return $this->belongsTo(Estado::class, 'id');
    }

    public function id_role(){
        return $this->belongsTo(Role::class, 'id');
    }

    public function id_tipo_documento(){
        return $this->belongsTo(Tipo_documento::class, 'id');
    }

    public function id_medidas(){
        return $this->hasMany(Medida::class, 'id_cliente');
    }

    public function id_mensualidad(){
        return $this->hasMany(Mensualidad::class, 'id_cliente');
    }


     /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "usuarios";

    /**
     * @var array
     */
    protected $fillable = [
        'id_tipo_documento','numero_documento','nombre_completo', 'telefono','direccion','email','password' ,'id_role', 'id_estado'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
