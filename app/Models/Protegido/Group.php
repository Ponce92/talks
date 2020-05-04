<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='groups';

    public function __construct(array $attributes = [])
    {
        $this->setState(false);
        parent::__construct($attributes);
    }


    /**
     * Getters and Setters . . .
     */

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        return $this->id=$id;
    }
    public function setName($name){
        $this->cs_name=$name;
    }
    public function getName(){
        return $this->cs_name;
    }
    public function setDesc($desc){
        $this->cs_desc=$desc;
    }
    public function getDesc(){
        return $this->cs_desc;
    }

    public function isActivo(){
        if($this->cb_state){
            return true;
        }
        return false;
    }
    public  function setState($state){
        $this->cb_state=$state;
    }

    public function getGroup()
    {
        return $this->cs_group;
    }
    public function setGroup($gr)
    {
        $this->cs_group=$gr;
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
