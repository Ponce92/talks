<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Position;
use App\Models\Protegido\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            return datatables()
                ->eloquent(Position::query())
                ->addColumn('acctions','payroll.positions.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }else{
            return view('payroll.positions.index');
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
            $position=new Position();
            $html=view('payroll.positions.create')
                ->with('obj',$position)
                ->render();

            return response()->json(array('status'=>true,'html'=>$html));
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
        $status='error';
        $html='';
        $isValid=Validator::Make($request->all(),[
            'name'=>'required|string|min:4|max:50|unique:positions,cs_name',
            'code'=>'required|string|min:2|max:12|unique:positions,cs_name',
            'level'=>'required|int|min:1|max:15',
            'lob'=>'required|string|min:2|max:50',
        ]);

        $obj= new Position();
        $obj->setName($request->name);
        $obj->setCode($request->code);
        $obj->setLevel($request->level);
        $obj->setLob($request->lob);


        if($isValid->fails()){
            $band=false;
            $html=view('payroll.positions.create')
                ->withErrors($isValid)
                ->with('obj',$obj)
                ->render();

        }else{
            $obj->save();
            $html="";
            $status="success";
        }

        return response()->json(array('valor'=>$status, 'html'=>$html));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $status="success";

        $html=view('payroll.positions.position')
            ->with('obj',$position)
            ->render();

        return response()->json(array('html'=>$html,"status"=>$status));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $status='error';
        $html='';
        $var=Validator::Make($request->all(),[
            'name'=>['required','string','min:4','max:50',Rule::unique('positions','cs_name')->ignore($request->id)],
            'code'=>['required','string','min:2','max:50',Rule::unique('positions','cs_code')->ignore($request->id)],
            'level'=>'required|int|min:1|max:15',
            'lob'=>'required|string|min:2|max:50',
        ]);

        $position->setName($request->name);
        $position->setCode($request->code);
        $position->setLevel($request->level);
        $position->setLob($request->lob);

        if($var->fails()){
            $status='fails_validation';
            $html=view('payroll.positions.position')
                ->withErrors($var)
                ->with('obj',$position)
                ->render();

        }else{
            $position->save();
            $status='success';
            $html='';
        }

        return response()->json(array('status'=>$status, 'html'=>$html));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}
