<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\AreaOperativa;
use App\Models\Payroll\Department;
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
            $sql=<<<EOT
select j.id,j.cs_code,j.cb_state,
        d.cs_name as dep,
        p.cs_name as pos,
        (select ej.employee_id from employee_job ej
            where ej.job_id=j.id and ej.cb_state=true ) as vacant from jobs j
                join departments d on j.department_id = d.id
                join positions p on j.position_id = p.id
EOT;
            if($request->position > 0)
            {
                $sql=$sql.' where p.id='.$request->position;
            }
            if($request->status=="on")
            {
                $sql=$sql.' and j.id not in (select job_id from employee_job where job_id=j.id and j.cb_state=true)';
            }
            $sql=$sql.";";
            $query=DB::select($sql);
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
        if($request->ajax())
        {
            $departments=Department::all();
            $job=new Job();
            $html=view('payroll.jobs.job')
                ->with('departments',$departments)
                ->with('obj',$job)
                ->render();
            return response()
                    ->json(array('status'=>true,'html'=>$html));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $valid=Validator::Make($request->all(),[
            'department'=>'required|int|min:1',
            'positionSel'=>'required|int|min:1',
            'vacantes'=>'required|int|min:1|max:10',
        ]);


        if($valid->fails()){
            $mess=FlashMessage::getMessage('danger','Error en los datos ingresados en el formulario . . .');
            $band=false;
            $html=view('payroll.jobs.job')
                ->with('flash',$mess)
                ->with('department',$request->department)
                ->with('positionSel',$request->positionSel)
                ->with('vacantes',$request->vacantes)
                ->with('departments',Department::all())
                ->withErrors($valid)
                ->render();
        }else{

            $band=true;
            $html="";

            $position=Position::find($request->positionSel);
            $department=Department::find($request->department);
            for($i=0;$i<$request->vacantes;$i++)
            {
                $job=new Job();
                $job->setCode($this->generateCodeJob($department,$position));
                $job->setState(false);
                $job->setDepartment($department);
                $job->setPosition($position);

                $job->save();
            }
        }

        return response()->json(array('valor'=>$band, 'html'=>$html));
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
     * Retorna los puestos ligados a un departamento
     */

    public function getAreas($id){
        $areas=AreaOperativa::where('cs_department_code',Department::find($id)->getCode())->get();
        return response()
            ->json(array('status'=>'success',
                            'options'=>$areas,
                            'msj'=>"El departamento no posee areas operativas, primero debe crear el area"
                    ));
    }

    /**
     * @param $dep
     * @param $pos
     * Descripcion: genera el codigo asignado a cierta vacantes
     */
    private function generateCodeJob($dep,$pos)
    {
        $number=DB::table('jobs')
            ->where('position_id',$pos->getId())
            ->count();
        $code=$pos->getCode().' - '.str_pad($number,4,'0',STR_PAD_LEFT );

        return $code;
    }

    function getPositios(int $dep,int $area)
    {
        dd($dep.'<=======>'.$area);
    }
}
