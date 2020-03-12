<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='roles';
    public $timestamps=false;

    public function __construct(array $attributes = [])
    {
        $this->setState(true);
        parent::__construct($attributes);
    }


/**
 * getter and setters
 */

    public function getId(){
        return $this->id;
    }

    public function getName(){

        return $this->cs_name;
    }
    public function setName($valor){
        $this->cs_name=$valor;
    }

    public function setDesc($desc){
        $this->cs_desc=$desc;
    }

    public function getNombre(){
        return $this->cs_name;
    }
    public function getDesc(){
        return $this->cs_desc;
    }

    public function isActive(){
        return $this->cb_state;
    }
    public function setState($valor){
        $this->cb_state=$valor;
    }

    /**
     * Relacion de muchos a muchos desde roles (un rol puede ver sus permisos)
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

}
