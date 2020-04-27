<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey='id';
    protected $table='departments';
    public $timestamps=false;

    /**
     * Funciones getter and setters.......
     */

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getName(){
        return $this->cs_name;

    }
    public function setName($name){
        $this->cs_name=$name;
    }

    public function getCode(){
        return $this->cs_code;
    }
    public function setCode($code){
        $this->cs_code=$code;
    }

    public function getDesc(){
        return $this->cs_desc;
    }
    public function setDesc($desc){
        $this->cs_desc=$desc;
    }

    public function positions(){
        return $this->belongsToMany(Position::class);
    }
}

