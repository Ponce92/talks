<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey='id';
    protected $table='jobs';
    public $timestamps=false;

    private $employee;
    public function __construct(array $attributes = [])
    {
        $employee=null;
        parent::__construct($attributes);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getCode()
    {
        return $this->cs_code;
    }

    public function setCode($code)
    {
        $this->cs_code=$code;
    }
    public function getState()
    {
        return $this->cb_state;
    }
    public function setState($state)
    {
        $this->cb_state=$state;
    }

    public function setDepartment($dep){
        $this->department_id=$dep->getId();
    }
    public function setPosition($position)
    {
        $this->position_id=$position->getId();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
