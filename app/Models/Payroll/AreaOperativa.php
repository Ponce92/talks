<?php

namespace App\Models\Payroll;

use App\Models\Protegido\Permission;
use Illuminate\Database\Eloquent\Model;

class AreaOperativa extends Model
{
    protected $primaryKey="id";
    protected $table="ope_areas";
    public $timestamps=false;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id=$id;
    }

    public function getCode()
    {
        return $this->cs_code;
    }
    public function setCode($code)
    {
        $this->cs_code=$code;
    }

    public function getChief()
    {
    }
    public function setChief(Employee $employee)
    {
     $this->cs_chief_code=$employee->getCode();
    }

    public function getName()
    {
        return $this->cs_name;
    }
    public function setName($name)
    {
        $this->cs_name=$name;
    }

    public function getDesc()
    {
        return $this->cs_desc;
    }
    public function setDesc($desc)
    {
        $this->cs_desc=$desc;
    }

    public function isActivo()
    {
        if($this->cb_status){
            return true;
        }else{
            return false;
        }
    }
    public function setStatus($status){
        $this->cb_status=$status;
    }

    public function getDepartment(){
        $dep=Department::where("cs_code",$this->cs_department_code)->first();
        return $dep;
    }

    public function setDepartment(Department $department)
    {
        $this->cs_department_code=$department->getCode();
    }

    public function positions(){
        return $this->belongsToMany(Position::class,'ope_area_position','ope_area_id','position_id');
    }

}
