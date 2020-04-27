<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Department;
use App\Models\Payroll\Position;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
        $this->middleware('credential:puede_crear_departamentos')->only(['create','store']);
        $this->middleware('credential:puede_editar_departamentos')->only(['edit','update']);
        $this->middleware('credential:puede_eliminar_departamentos')->only(['delete']);
    }

    /**
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()
                ->eloquent(Department::query())
                ->addColumn('acctions','payroll.departments.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }else{
            return view('payroll.departments.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            //Si es ajax y metodo get retornamos un nuevo formulario vacio...
            $obj=New Department();
            $html=view('payroll.departments.create')
                ->with('obj',$obj)
                ->render();
            return response()->json(array('status'=>'success','html'=>$html));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            $band=false;
            $html=view('payroll.departments.create')
                ->withErrors($isValid)
                ->with('obj',$obj)
                ->render();

        }else{
            $obj->save();
            $band=true;
            $html="";
        }

        return response()->json(array('valor'=>$band, 'html'=>$html));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {

        return view('payroll.departments.edit')
            ->with('department',$department);
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

    public function getPositions($id){
        $status='success';
        $department=Department::find($id);
        $arreglo=Position::whereNotIn('id',DB::table('department_position')
                    ->select('position_id')
                    ->where('department_id','=',$department->getId()))
            ->get();

        $html=view('payroll.departments.positions_table')
            ->with('positions',$arreglo)
            ->render();
        return response()->json(array('status'=>'success','html'=>$html));
    }

    public function addPosition(Request $request){
        $department=Department::findOrFail($request->idDep);

        $department->positions()->attach($request->idPos);
        $resp='success';
        return response()->json(array('status'=>$resp));
    }

    public function getPositionsRelated($id){
        $department=Department::find($id);
        $status='success';
        $html=view('payroll.departments.positions_related')
            ->with('department',$department)
            ->render();
        return response()->json(array('status'=>$status,'html'=>$html));
    }

}
