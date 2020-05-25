<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Retirement extends Model
{
    protected $primaryKey='id';
    protected $table='employees_retirement';
    public $timestamps=false;

    public function __construct(array $attributes = [])
    {
        $this->cd_entry=date('y-m-d');
        parent::__construct($attributes);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setObservacion($obs)
    {
        $this->cs_retirement=$obs;
    }
    public function getObservacion()
    {
        return $this->cs_retirement;
    }

    public function setType(RetirementType $type =null){
        if($type)
        {
            $this->retirement_type=$type->getId();
        }

    }

    public function getType()
    {
        if($this->retirement_type){
            return RetirementType::find($this->retirement_type);

        }
        return new RetirementType();
    }

    public function getEmployee()
    {
        return Employee::where('cs_code',$this->cs_employee_code)->first();
    }
    public function setEmployee(Employee $employee)
    {
        $this->cs_employee_code=$employee->getCode();
    }


    public function getEntryDate()
    {
        return $this->cd_entry;
    }

    public function isRehireable(){

        $this->cb_rehireable ?  $val=true:$val=false;
            return $val;
    }
    public function setRehireable($val)
    {
        if($val){
            $this->cb_rehireable=true;
        }
        $this->cb_rehireable=false;
    }

}
