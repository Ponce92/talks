<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class ParkingTypes extends Model
{
    protected $table='parking_types';
    protected $primaryKey='id';
    public $timestamps=false;


    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->cs_name;
    }
    public function setName($name)
    {
        $this->cs_name=$name;
    }
}
