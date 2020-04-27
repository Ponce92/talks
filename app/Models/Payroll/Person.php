<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table='persons';
    public $primaryKey='id';
    public $timestamps=false;

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->cs_name;
    }

    public function setName($name)
    {
        $this->cs_name=$name;
    }

    public function getLastName()
    {
        return $this->cs_last_name;
    }

    public function setLastName($last_name)
    {
        $this->cs_last_name=$last_name;
    }

    public function getEmail()
    {
     return $this->cs_email;
    }

    public function setEmail($email)
    {
        $this->cs_email=$email;
    }

    public function getNit()
    {
        return $this->cs_nit;
    }

    public function setNit($nit)
    {
        $this->cs_nit=$nit;
    }

    public function getDui()
    {
        return $this->cs_dui;
    }

    public function setDui($dui)
    {
        $this->cs_dui=$dui;
    }

    public function getSexo()
    {
        $this->cb_sexo;
    }
    public function setSexo($sexo)
    {
        $this->cb_sexo=$sexo;
    }

    public function setMaritalStatus(MaritalStatus $status)
    {
        $this->marital_status_id=$status->getId();
    }
    public function getMaritalStaus()
    {
        return $this->belongsTo('Models\Payroll\MaritalStaus');
    }

    public function getBirthDate()
    {
        return $this->cd_birth_date;
    }
    public function setBirthDate($date)
    {
        $this->cd_birth_date=$date;
    }

    public function setAddress($dir)
    {
        $this->cs_address=$dir;
    }
    public function getAddress()
    {
        return $this->cs_address;
    }

}
