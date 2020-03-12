<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected  $table="permissions";
    public $timestamps=false;

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
    }

/**
 * Metodos de clase
 */

    public function getId(){
        return $this->id;

    }

    public function getName(){
        return $this->cs_name;
    }

    public function setName($val){
        $this->cs_name=$val;
    }
    public function getDesc(){
        return $this->cs_desc;
    }

    public function setDesc($desc){
        $this->cs_desc=$desc;
    }

    public function getCreatedAt(){
        return $this->cd_create_at;
    }

    public function setCreatedAt($date)
    {
        $this->cd_created_at=$date;
    }

    public function setActive($val)
    {
        $this->cb_activo=$val;
    }
    public function getUpdateAt(){
        return $this->cd_updated_at;
    }

    public function setUpdatedAt($value)
    {
        $this->cd_updated_at=$value;
    }


    public function isActive(){
        if($this->cb_active){
            return true;}
        return false;
    }
}
