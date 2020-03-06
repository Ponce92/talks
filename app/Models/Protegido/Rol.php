<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='tlk_roles';
    protected $primaryKey='rol_id';
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
        return $this->rol_id;
    }

    public function getName(){

        return $this->tt_name;
    }
    public function setName($valor){
        $this->tt_name=$valor;
    }

    public function setDesc($desc){
        $this->tt_desc=$desc;
    }

    public function getNombre(){
        return $this->tt_name;
    }
    public function getDesc(){
        return $this->tt_desc;
    }

    public function isActive(){
        return $this->tb_state;
    }
    public function setState($valor){
        $this->tb_state=$valor;
    }

    /**
     * Relacion de muchos a muchos desde roles (un rol puede ver sus permisos)
     */
    public function permissions(){
        return $this->belongsToMany(Permission::class,
                                    'tlk_rol_permision',
                            'fk_rol',
                            'fk_permission');
    }

}
