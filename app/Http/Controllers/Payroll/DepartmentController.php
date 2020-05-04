<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Department;
use App\Models\Payroll\Position;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('credential:puede_crear_departamentos')->only(['create','store']);
//        $this->middleware('credential:puede_editar_departamentos')->only(['edit','update']);
//        $this->middleware('credential:puede_eliminar_departamentos')->only(['delete']);
    }


    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()
                ->eloquent(Department::query())
                ->addColumn('acctions','payroll.departments.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }else{
            return view('payroll.departments.departments');
        }
    }


    public function create(Request $request)
    {
        if($request->ajax()){
            $dep=New Department();
            $html=view('payroll.departments.create')
                ->with('dep',$dep)
                ->render();

            //--------------------
            $resp=array(
                "html"=>$html,
                "stats"=>"success",
            );
            return response()->json($resp);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $isValid=Validator::Make($request->all(),[
            'name'=>'required|string|min:2|max:50|unique:departments,cs_name',
            'code'=>'required|string|min:2|max:50|unique:departments,cs_code',
            'desc'=>'required|string|min:6|max:250',
        ]);

        $obj=new Department();
        $obj->setName($request->name);
        $obj->setCode($request->code);
        $obj->setDesc($request->desc);

        if($isValid->fails()){

            $status="forms-errors";
            $html=view('payroll.departments.create')
                ->withErrors($isValid)
                ->with('dep',$obj)
                ->render();

        }else{
            $obj->save();
            $dep=new Department();
            $status="success";
            $html=view('payroll.departments.create')
                ->with('dep',$dep)
                ->render();
        }
        //--------------\
        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );

        return response()
            ->json($resp);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Department  $department
     */
    public function show(Department $department)
    {
        return  view('payroll.departments.department')
                ->with('department',$department);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Department  $department

     */
    public function edit(Department $department)
    {
        $status="success";
        $html=view('payroll.departments.edit')
            ->with('dep',$department)
            ->render();
        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );

        return response()
            ->json($resp);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $isValid=Validator::Make($request->all(),[
            'name'=>['required','string','min:2','max:50',Rule::unique('departments','cs_name')
                ->ignore($department->getId(),'id')],

            'code'=>['required','string','min:2','max:50',
                        Rule::unique('departments','cs_name')
                                ->ignore($department->getId(),'id')
                    ],
            'desc'=>'required|string|min:6|max:250',
        ]);

        $department->setName($request->name);
        $department->setCode($request->code);
        $department->setDesc($request->desc);

        if($isValid->fails()){

            $status="forms-errors";
            $html=view('payroll.departments.edit')
                ->withErrors($isValid)
                ->with('dep',$department)
                ->render();

        }else{
            $department->save();
            $status="success";
            $html=view('payroll.departments.edit')
                ->with('dep',$department)
                ->render();
        }
        //--------------\
        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );

        return response()
            ->json($resp);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

}
