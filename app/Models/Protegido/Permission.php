<?php

namespace App\Models\Protegido;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected  $table="tlk_permissions";
    protected $primaryKey="pk_id";
    public $timestamps=false;

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
    }

/**
 * Metodos de clase
 */

    public function getId(){
        return $this->pk_id;

    }

    public function getName(){
        return $this->ts_name;
    }

    public function setName($val){
        $this->ts_name=$val;
    }
    public function getDesc(){
        return $this->td_desc;
    }

    public function setDesc($desc){
        $this->td_desc=$desc;
    }

    public function getCreatedAt(){
        return $this->tf_create_at;
    }

    public function setCreatedAt($date)
    {
        $this->tf_created_at=$date;
    }

    public function setActive($val)
    {
        $this->tb_active=$val;
    }
    public function getUpdateAt(){
        return $this->tf_updated_at;
    }

    public function setUpdatedAt($value)
    {
        $this->tf_updated_at=$value;
    }


    public function isActive(){
        if($this->tb_active){
            return true;}
        return false;
    }
}
