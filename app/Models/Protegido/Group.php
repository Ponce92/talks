<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='tlk_groups';
    protected $primaryKey='id';

    public function __construct(array $attributes = [])
    {
        $this->setState(false);
        parent::__construct($attributes);
    }


    /**
     * Getters and Setters . . .
     */
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

    public function getState(){
        if($this->cb_state){
            return true;
        }
        return false;
    }
    public  function setState($state){
        $this->cb_state=$state;
    }
}
