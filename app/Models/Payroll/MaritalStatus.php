<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $primaryKey='id';
    protected $table="marital_status";
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
