<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table='employees';
    public $primaryKey='id';
    public $timestamps=false;

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->cs_code;
    }
    public function setCode($cod)
    {
        $this->cs_code=$cod;
    }

    public function getUserVic()
    {
       return $this->cs_user_vic;
    }
    public function setUserVic($user)
    {
        $this->cs_user_vic=$user;
    }

    public function getEntryDate()
    {
        return $this->cd_entry_date;
    }
    public function setEntryDate($entryDate)
    {
        $this->cd_entry_date=$entryDate;
    }

    public function getEndDate()
    {
        return $this->cd_end_date;
    }
    public function setEndDate($endDate)
    {
        $this->cd_end_date=$endDate;
    }

    public function getHeadsetCode()
    {
        return $this->cs_headset_code;
    }
    public function setHeadsetCode($code)
    {
        $this->cs_headset_code=$code;
    }

    public function getEmail(){
        return $this->cs_email;
    }
    public function setEmail($email)
    {
        $this->cs_email=$email;
    }

    public function getLoker()
    {
        return   $this->cs_loker;
    }
    public function setLoker($loker)
    {
        $this->cs_loker=$loker;
    }

    public function getBiometric()
    {
        return $this->cs_biometric;
    }
    public function setBiometric($code)
    {
        $this->cs_biometric=$code;

    }

//    Funciones que deben manipulan un modelo . . . . . . . . . . . .

    public function person()
    {
        return $this->belongsTo('App\Models\Payroll\Person');
    }
    public function setPerson(Person $person)
    {
     $this->person_id=$person->getId();
    }

    public function employeeStatus()
    {
        return $this->belongsTo('App\Models\Payroll\EmployeeStatus');
    }

    public function setEmployeeStatus(EmployeeStatus $status)
    {
        $this->employee_status_id=$status->getId();
    }

    public function contractType()
    {
        return $this->belongsTo('App\Models\Payroll\ContractTypes');
    }
    public function setContractType(ContractTypes $type)
    {
        $this->contract_type_id=$type->getId();
    }

    public function parkingType()
    {
        return $this->belongsTo('App\Models\Payroll\ParkingTypes');
    }
    public function setParkingType(ParkingTypes $type)
    {
        $this->parking_type_id=$type->getId();
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Payroll\Position');
    }
    public function setPosition(Position $pos)
    {
        $this->position_id=$pos->getId();
    }

    public function department(){
        return $this->belongsTo('App\Models\Payroll\Department');
    }
    public function setDepartment(Department $dep)
    {
        $this->department_id=$dep->getId();
    }

}
