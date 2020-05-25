<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;
use DB;

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
    public function setChief(Job $job){
        $this->chief_code=$job->getCode();
    }

    public function getState()
    {
        return $this->cb_state;
    }
    public function setState($state)
    {
        $this->cb_state=$state;
    }

    public function setDepartment(Department $dep)
    {
        $this->department_id=$dep->getId();
    }
   public function setArea(AreaOperativa $area =null)
    {
        if($area)
        {
            $this->area_id=$area->getId();
        }

    }
    public function getArea()
    {
        if($this->area_id){
            return AreaOperativa::find($this->area_id);
        }
        return new AreaOperativa();
    }



    public function setPosition(Position $position)
    {
            $this->position_id=$position->getId();
    }

    public function getDep()
    {
        if($this->department_id)
        {
            return Department::find($this->department_id);
        }
        return new Department();
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Funciones que se utlizan para manipular el empleado de la plaza
     *
     */

    public function getEmployee()
    {
     $id=DB::table('employee_job')
            ->where('job_id',$this->getId())
            ->where('cb_state',true)
            ->select('employee_id')
            ->first();
     if($id != null) {
         $employee = Employee::find($id);
     }else{
         $employee=new Employee();
     }

     return $employee;
    }
    //inserta una instancia de employee_job
    //coloca el estado de esa en activo
    public function setEmployee(Employee $employee)
    {
        DB::beginTransaction();
        try {
            DB::table('employee_job')
                ->where('employee_id','=',$employee->getId())
                ->where('cb_state',true)
                ->update(['cb_state'=>false,
                    'cd_end'=>date('y-m-d')
                ]);
            DB::table('employee_job')
                ->insert([
                    'employee_id'=>$employee->getId(),
                    'job_id'=>$this->getId(),
                    'cd_entry'=>date('Y-m-d'),
                    'cs_contract_type'=>'none',
                    'cb_state'=>true
                ]);

            DB::commit();

        }catch (\Exception $e){

            DB::rollback();
            dd($e->getMessage());
            return false;
        }
        return true;
    }
    //funcion que da por finalizado la relacion employee job..
    //setea el estado de la relacion a false
    //Setea la finalizacion fecha end

    public function clearEmployee(Employee $employee)
    {
        DB::table('employee_job')
            ->update(['cb_state'=>false,
                'cd_end'=>date('y-m-d')
            ])
            ->where('employee_id','=',$employee->getId())
            ->where('cb_state',true);
    }

}
