<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $primaryKey='id';
    protected $table='positions';
    public $timestamps=false;

    public function __construct(array $attributes = [])
    {
        $this->cb_req_chief=false;
        $this->cb_req_dep=false;
        $this->cb_has_subs=false;
        $this->cb_req_area=false;
        parent::__construct($attributes);
    }

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

    public function getDesc()
    {
        return $this->cs_desc;
    }
    public function setDesc($desc)
    {
        $this->cs_desc=$desc;
    }

    public function setReqChief($val)
    {
        $this->cb_req_chief=$val;
    }

    public function reqChief(){
        if($this->cb_req_chief==true){
            return true;
        }
        return false;
    }

    public function setReqArea($val)
    {
        $this->cb_req_area=$val;
    }
    public function reqArea(){
        if($this->cb_req_area==true){
            return true;
        }

        return false;
    }

    public function setHasSubs($val)
    {
        $this->cb_has_subs=$val;
    }
    public function hasSubs(){
        if($this->cb_has_subs==true){
            return true;
        }
        return false;
    }

    public function setReqDep($val)
    {
        $this->cb_req_dep=$val;
    }
    public function reqDep(){
        if($this->cb_req_dep==true){
            return true;
        }
        return false;
    }

    public function setChief(Position $position)
    {
        $this->position_id=$position->getId();
    }
    public function getChief(){
        if($this->position_id){
            return Position::find($this->position_id);

        }
        return new Position();
    }
}
