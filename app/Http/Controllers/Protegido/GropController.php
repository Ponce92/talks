<?php

namespace App\Http\Controllers\Protegido;

use App\Models\Protegido\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GropController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('credential:puede_crear_grupos')->only(['create','store']);
        $this->middleware('credential:puede_editar_grupos')->only(['edit','update']);
        $this->middleware('credential:puede_eliminar_grupos')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){

            return datatables()
                ->eloquent(Group::query())
                ->addColumn('acctions','protected.grupos.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }else{
            return view('protected.grupos.index');
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
            $html=view('protected.grupos.create')->render();
            return response()->json(array('valor'=>true,'html'=>$html));
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
            'name'=>'required|string|min:4|max:50|unique:groups,cs_name',
            'desc'=>'required|string|min:6|max:250',
            'estado'=>''
        ]);

        if($isValid->fails()){
            //retornamos la vista crear con correcciones;
            $band=false;
            $html=view('protected.grupos.create')
                ->withErrors($isValid)
                ->with('name',$request->name)
                ->with('desc',$request->desc)
                ->with('estado',$request->estado)
                ->render();

        }else{
            //Se crea y almacena el nuevo rol creado
            $obj=new Group;

            $obj->setName($request->name);
            $obj->setDesc($request->desc);

            if($request->estado){
                $obj->setState(true);
            }else{
                $obj->setState(false);
            }

            $obj->save();
            $band=true;
            $html="";
        }

        return response()->json(array('valor'=>$band, 'html'=>$html));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $status="success";
        $html=view('protected.grupos.edit')
            ->with('Object',$group)
            ->render();
        return response()->json(array('valor'=>true,'html'=>$html,"status"=>$status));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $var=Validator::make($request->all(),[
            'name'=>['required','string','min:4','max:50',Rule::unique('groups','cs_name')->ignore($request->id,'pk_id')],
            'desc'=>'required|min:3|string|max:600',
        ]);

        $group->setName($request->name);
        $group->setDesc($request->desc);
        $request->estado ? $group->setState(true):$group->setState(false);

        if($var->fails()){
            $status='fails_validation';
            $html=view('protected.grupos.edit')
                ->withErrors($var)
                ->with('Object',$group)
                ->render();

        }else{
            $group->save();
            $status='success';
            $html='';
        }

        return response()->json(array('status'=>$status, 'html'=>$html));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //

    }
}
