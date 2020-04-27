<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class ContractTypes extends Model
{

    protected $table='contract_types';
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
