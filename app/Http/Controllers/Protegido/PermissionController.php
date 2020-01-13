<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Protegido\Permission;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Datatable;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        if($request->ajax()){
            return datatables()
                ->eloquent(Permission::query())
                ->addColumn('acctions','protected.permissions.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }

        return view('protected.permissions.index');
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
            $html=view('protected.permissions.create')->render();
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
        if($request->ajax() && $request->method()=='POST'){
                $band=false;
                $html='';
                $isValid=Validator::Make($request->all(),[
                    'name'=>'required|string|min:3|max:50|unique:tlk_permissions,ts_name',
                    'desc'=>'required|string|min:4|max:250',
                    'estado'=>''
                ]);

                if($isValid->fails()){
                    //retornamos la vista crear con correcciones;
                    $band=false;
                    $html=view('protected.permissions.create')
                        ->withErrors($isValid)
                        ->with('name',$request->name)
                        ->with('desc',$request->desc)
                        ->with('estado',$request->estado)
                        ->render();

                }else{
                    //Se crea y almacena el nuevo rol creado
                    $obj=new Permission;

                    $obj->setName($request->name);
                    $obj->setDesc($request->desc);

                    $obj->setCreatedAt(Date::now());
                    $obj->setUpdatedAt(Date::now());

                    if($request->estado){
                        $obj->setActive(true);
                    }else{
                        $obj->setActive(false);
                    }

                    $obj->save();
                    $band=true;
                    $html="";
                }

                return response()->json(array('valor'=>$band, 'html'=>$html));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if($request->ajax())
        {
            $obj=Permission::find($id);
            $status="success";
            $html=view('protected.permissions.edit')
                ->with('Object',$obj)
                ->render();
            return response()->json(array('valor'=>true,'html'=>$html,"status"=>$status));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status='errors';
        $html='';
        if($request->ajax() && $request->method()=="PUT"){
            $var=Validator::make($request->all(),[
                'id'=>'required|int',
                'name'=>'required|min:3|max:250',
                'desc'=>'required|min:3|string|max:600',
            ]);
        }

        if($var->fails()){
            $status='fails_validation';
            $html=view('protected.permissions.edit')
                ->withErrors($var)
                ->with('id',$request->id)
                ->with('name',$request->name)
                ->with('desc',$request->desc)
                ->with('state',$request->estado)
                ->render();

        }else{
            $permiso=Permission::find($request->get('id'));
            $permiso->setName($request->get('name'));
            $permiso->setDesc($request->get('desc'));
            $permiso->setUpdatedAt(Date::now());
            $request->estado ? $permiso->setActive(true):$permiso->setActive(false);

            $permiso->save();
            $status='success';
        }

        return response()->json(array('status'=>$status, 'html'=>$html));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status='not_found';
        try {
            Permission::destroy($id);
            $status='success';
        }catch (\Exception $exception){
            $status='error';
        }

        return  response()->json(array('status'=>$status,'html'=>''));
    }
}
