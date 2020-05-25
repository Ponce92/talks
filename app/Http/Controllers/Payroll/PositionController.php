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

     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $status="success";
            $position=new Position();


            $html=view('payroll.positions.create')
                ->with('position',$position)
                ->with('chiefs',Position::all())
                ->render();

            //--------------------
            $resp=array(
                "html"=>$html,
                "status"=>$status
            );

            return response()->json($resp);
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
            'name'=>'required|string|min:4|max:50|unique:positions,cs_name',
            'code'=>'required|string|min:3|max:3|unique:positions,cs_code',
            'chiefP'=>'required_with:chief',
            'desc'=>'',
        ]);

        $position= new Position();
        $position->setName($request->name);
        $position->setCode($request->code);
        $position->setDesc($request->desc);
        if($request->chiefP)
        {
            $position->setChief(Position::find($request->chiefP));
        }

        if($request->chief)
        {
            $position->setReqChief(true);
        }

        if($request->subs)
        {
            $position->setHasSubs(true);
        }
        if($request->depa)
        {
            $position->setReqDep(true);
        }
        if($request->area)
        {
            $position->setReqArea(true);
        }

        if($isValid->fails()){
            $status="form_errors";
            $html=view('payroll.positions.create')
                ->withErrors($isValid)
                ->with('chiefs',Position::all())
                ->with('position',$position)
                ->render();

        }else{
            $position->save();
            $html="";
            $status="success";
        }

        //------------------------------
        $resp=array(
            "html"=>$html,
            "status"=>$status,
            );
        return response()->json($resp);
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

        $html=view('payroll.positions.edit')
            ->with('position',$position)
            ->with('chiefs',Position::all())
            ->render();
        //--------------------
        $resp=array(
            "html"=>$html,
            "status"=>$status
        );

        return response()->json($resp);
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
        $isValid=Validator::Make($request->all(),[
            'name'=>['required',
                    'string',
                    'min:2',
                    'max:50',
                    Rule::unique('positions','cs_name')
                        ->ignore($position->getId(),'id')],
            'code'=>['required',
                'string',
                'min:3',
                'max:3',
                Rule::unique('positions','cs_code')
                    ->ignore($position->getId(),'id')],
            'desc'=>'',
            'chiefP'=>'required_with:chief',
        ]);

        $position->setName($request->name);
        $position->setCode($request->code);
        $position->setDesc($request->desc);

       $request->chief ? $position->setReqChief(true):$position->setReqChief(false);
       $request->subs  ? $position->setHasSubs(true):$position->setHasSubs(false);
       $request->depa  ? $position->setReqDep(true):$position->setReqDep(false);
       $request->area  ? $position->setReqArea(true):$position->setReqArea(false);

        if($isValid->fails()){
            $status="form_errors";
            $html=view('payroll.positions.edit')
                ->withErrors($isValid)
                ->with('chiefs',Position::all())
                ->with('position',$position)
                ->render();

        }else{
            $position->save();
            $html="";
            $status="success";
        }

        //------------------------------
        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );
        return response()->json($resp);
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
