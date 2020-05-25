<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class RetirementType extends Model
{
    protected $table='retirement_types';
    protected $primaryKey='id';
    public $timestamps=false;

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->cs_name;
    }
}
