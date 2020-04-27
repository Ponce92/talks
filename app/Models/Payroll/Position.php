<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $primaryKey='id';
    protected $table='positions';
    public $timestamps=false;


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getCode(){
        return $this->cs_code;
    }
    public function setCode($code){
        $this->cs_code=$code;
    }

    public function getLevel(){
        return $this->cn_level;
    }
    public function setLevel($level){
        $this->cn_level=$level;
    }
    public function getName(){
        return $this->cs_name;

    }
    public function setName($name){
        $this->cs_name=$name;
    }
    public function getLob(){
        return $this->cs_lob;
    }
    public function setLob($lob){
        return $this->cs_lob=$lob;
    }
}
