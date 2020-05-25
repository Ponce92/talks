<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\AreaOperativa;
use App\Models\Payroll\Department;
use App\Models\Payroll\Employee;
use App\Models\Payroll\Job;
use App\Models\Payroll\Position;
use App\Models\Util\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query=DB::table('jobs as jo')
                ->where('jo.cb_state',true)
                ->leftJoinSub('select * from employee_job as ej where ej.cb_state = true','ej',function ($join){
                    $join->on('jo.id','=','ej.job_id');
                })
                ->leftJoin('employees as em','ej.employee_id','em.id')
                ->join('positions as po','jo.position_id','po.id')
                ->leftjoin('persons as pe','em.person_id','pe.id')
                ->select(
                    "jo.id as id",
                    "jo.cs_code as jocode",
                    "po.cs_name as poname",
                    "em.cs_code as emcode",
                    "po.cb_has_subs as subs",
                    DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as emname')
                )
                ->get();

            return datatables()
                ->collection($query)
                ->addColumn('acctions','payroll.jobs.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }
        return view('payroll.jobs.index')
                        ->with('puestos',Position::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {
        //...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $valid=Validator::Make($request->all(),[
            'position'=>'required|int',
            'vacantes'=>'required|int|min:1|max:10',
            'department'=>'required_with:reqDep|int',
            'area'=>'required_with:reqArea|int',
        ]);

        $position=Position::find($request->position);
        $job=New Job();



        if($valid->fails()){

            $job->setPosition($position);
            if($request->department)
            {
                $department=Department::find($request->department);
                $job->setDepartment($department);
            }

            if($request->area)
            {
                $area=AreaOperativa::find($request->area);
                $job->setArea($area);
            }

            $status='form_errors';
            $html=view('payroll.jobs.job')
                ->with('job',$job)
                ->with('vacantes',$request->vacantes)
                ->with('departments',Department::all())
                ->withErrors($valid)
                ->render();
        }else{

            $status="success";
            $html="";

            for($i=0;$i<$request->vacantes;$i++)
            {
                $job=new Job();

                $job->setPosition($position);
                if($request->department)
                {
                    $department=Department::find($request->department);
                    $job->setDepartment($department);
                }

                if($request->area)
                {
                    $area=AreaOperativa::find($request->area);
                    $job->setArea($area);
                }
                $job->setCode($this->generateCodeJob($position));
                $job->setState(true);

                $job->save();

            }
        }

        return response()->json(
            array(  'status'=>$status,
                    'html'=>$html
            ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Job  $job
     */
    public function edit(Job $job)
    {
            $html=view('payroll.jobs.edit')
                ->with('obj',$job)
                ->render();
            return response()
                    ->json(array('status'=>true,'html'=>$html));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    /**
     * Retorna los registros que pueden ser asignados a la plaza
     */

    public function candidatos(Job $job)
    {
        try{
            $html=view('payroll.jobs.asignacion')
                ->with('job',$job)
                ->render();
            $status='success';
        }catch (\Exception $e){
            $status='render_error';
            $html="No se ha logrado rederizara la vista..";
        }
        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );

        return response()->json($resp);
    }

    /**
     * Retorna los puestos ligados a un departamento
     */

    public function getAreas(Request $request)
    {
        $areas=AreaOperativa::where('cs_department_code',Department::find($request->departamento)->getCode())->get();

        return response()
            ->json(array('status'=>'success',
                            'options'=>$areas,
                            'msj'=>"El departamento no posee areas operativas, primero debe crear el area"
                    ));
    }

    function getPositions(Request $request)
    {
        if($request->area!=''){
            $area=AreaOperativa::find($request->area);
            $list=Position::whereIn('id',function ($query) use ($area)
                    {
                        $query->select('position_id')
                            ->from('ope_area_position')
                            ->where('ope_area_id',$area->getId());
                    })
                ->get();
        }
        if($request->area==''){

            $list=Position::where('cb_req_area',false)
                ->where('cb_has_subs',true)
                ->get();
        }


        $html=view('payroll.jobs.positions')
            ->with('list',$list)
            ->render();

        return response()
            ->json(array('status'=>'success','html'=>$html));

    }

    public function crear(Position $position)
    {
        $job= new Job();
        $job->setPosition($position);
        $job->setDepartment(new Department());
        $job->setArea(new AreaOperativa());

        $html=view('payroll.jobs.job')
            ->with('job',$job)
            ->with('departments',Department::all())
            ->render();

            //=======================

        return response()
            ->json(array('status'=>'success','html'=>$html));
    }



    /**
     * @param $dep
     * @param $pos
     * Descripcion: genera el codigo asignado a cierta vacantes
     */
    private function generateCodeJob($pos)
    {
        $number=DB::table('jobs')
            ->where('position_id',$pos->getId())
            ->count();
        $code=$pos->getCode().str_pad($number,4,'0',STR_PAD_LEFT );

        return $code;
    }


    /**
     *
     */
    private function getListChief(Job $job)
    {
        if($job->position->reqArea()==true && $job->position->hasSubs()==false)
        {
            /**
             * ooperadore, WFM, BO y mas
             * Los puestos que tienen area asignada y que no puedan tener subalternos
             * la lista de jefe son puestos de la misma area que puedan tener sub alternos
             * por defecto dependen del jefe del departamento
             */
            $list=null;
            return $list;
        }

        if($job->position->reqArea()==true && $job->position->hasSubs()==true)
        {
            /** jefe de area y jefe de departamento...
             * supervidores, jefes de area y mas
             * Estos los jefes de estos puestos deben ser jefe de area o jefe de departamento
             */
            $list=null;
            return $list;
        }

        if($job->position->reqDep()==true && $job->position->reqArea()==false && $job->position->hasSubs()==true)
        {
            /**
             *
             */

            $list=null;
            return $list;
        }

        if($job->position->reqDep()==false && $job->position->reqArea()==false && $job->position->hasSubs()==true)
        {
            /**
             *
             */
            $list=null;
            return $list;
        }

    }


    /**
     * Funcion que guarda las asignacines de empleado . . .
     */
    public function storeAssignment(Request $request)
    {
        $valid=Validator::Make($request->all(),[
            'jobId'=>'required',
            'employeeCode'=>'required',
        ]);
        try {

            $job=Job::find($request->jobId);
            $employee=Employee::where('cs_code',$request->employeeCode)->first();
            if($valid->fails())
            {
                $status="form_errors";
                $html= view('payroll.jobs.asignacion')
                    ->withErrors($valid)
                    ->with('job',$job)
                    ->render();

                return response()->json(
                    array(  'status'=>$status,
                        'html'=>$html
                    ));
            }

            $band=$job->setEmployee($employee);
            if($band){
                $status='success';
                $html='';
            }else{
                $status='transaccion_error';
                $html='No se pudo completar la trasaccion';
            }
        }catch (\Exception $e){
            $status='fatal_error';
            $html='El servidor ha fracasado...';
        }

        return response()->json(
                 array(  'status'=>$status,
                        'html'=>$html
                ));
    }



    /**
     * Funion que retorna el codigo del empleado y el nombre planilla de dicho empleado
     * acepta multiples parametros para retornar un filtrado
     */
    public function employees(Request $request,Job $job)
    {
        if(!$request->ajax()){ abort(404,'Method not found . . .');}

        $query=DB::table('persons as pe')
            ->join('employees as em','pe.id','=','em.person_id')
            ->join('positions as po','em.cs_position_code','=','po.cs_code')
            ->join('employee_status as es','em.employee_status_id','=','es.id')
            ->where('po.cs_code',$job->position->getCode())
            ->whereIn('es.cs_name',['Activo','Ingresado'])
            ->select(
                "em.cs_code as code",
                DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as full_name'),
                "po.cs_name as cargo",
                "es.cs_name as estado"
                )
            ->get();
        return datatables()
            ->collection($query)
            ->toJson();
    }

    /**
     * Funion que retorna el codigo del empleado y el nombre planilla de dicho empleado
     * acepta multiples parametros para retornar un filtrado
     */
    public function chiefEmployee(Request $request, Job $job)
    {
        if(!$request->ajax()){ abort(404,'Method not found . . .');}

        $query=DB::table('jobs as jo')
                    ->leftJoin('employee_job as ej','ej.job_id','jo.id')
                    ->leftJoin('employees as em','ej.employee_id','em.id')
                    ->join('positions as po','jo.position_id','po.id')
                    ->leftjoin('persons as pe','em.person_id','pe.id')
            ->select(
                "jo.cs_code as jocode",
                "po.cs_name as poname",
                "em.cs_code as emcode",
                DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as emname')
            )
            ->get();

        return datatables()
            ->collection($query)
            ->toJson();
    }

    /**
     * Asingacion de subalternos
     */
    public function subs(Job $job)
    {

        return view('payroll.jobs.job.subs')->with('job',$job);
    }
    public function subsIn(Job $job)
    {
        $query=DB::table('jobs as jo')
            ->where('jo.cb_state',true)
            ->leftJoinSub('select * from employee_job as ej where ej.cb_state = true','ej',function ($join){
                $join->on('jo.id','=','ej.job_id');
            })
            ->leftJoin('employees as em','ej.employee_id','em.id')
            ->join('positions as po','jo.position_id','po.id')
            ->leftjoin('persons as pe','em.person_id','pe.id')
            ->where('jo.chief_code',$job->getCode())
            ->select(
                "jo.id as id",
                "jo.cs_code as jocode",
                "po.cs_name as poname",
                "em.cs_code as emcode",
                "po.cb_has_subs as subs",
                DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as emname')
            )
            ->get();

        return datatables()
            ->collection($query)
            ->addColumn('acctions','payroll.jobs.job.accionOut')
            ->rawColumns(['acctions'])
            ->toJson();
    }

    public function subsInStore(Request $request,Job $job)
    {
        $status='success';
        $html='';

        $job->setChief(Job::find($request->id));
        $job->save();
        return response()->json(
            array(  'status'=>$status,
                'html'=>$html
            ));
    }


    public function subsOut(Job $job)
    {
        $query=DB::table('jobs as jo')
            ->where('jo.cb_state',true)
            ->leftJoinSub('select * from employee_job as ej where ej.cb_state = true','ej',function ($join){
                $join->on('jo.id','=','ej.job_id');
            })
            ->leftJoin('employees as em','ej.employee_id','em.id')
            ->join('positions as po','jo.position_id','po.id')
            ->leftjoin('persons as pe','em.person_id','pe.id')
            ->where('po.position_id',$job->position->getId())
            ->where('jo.chief_code',null)
            ->select(
                "jo.id as id",
                "jo.cs_code as jocode",
                "po.cs_name as poname",
                "em.cs_code as emcode",
                "po.cb_has_subs as subs",
                DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as emname')
            )
            ->get();

        return datatables()
            ->collection($query)
            ->addColumn('acctions','payroll.jobs.job.accionIn')
            ->rawColumns(['acctions'])
            ->toJson();
    }
    public function subsOutStore(Request $request,Job $job)
    {
        $status='success';
        $html='';

        $job->setChief(new Job());
        $job->save();
        return response()->json(
            array(  'status'=>$status,
                'html'=>$html
            ));
    }
}
