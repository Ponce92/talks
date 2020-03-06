<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Protegido\Rol;
use Datatable;

class RolController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('credential:puede_crear_roles')->only(['create','store']);
        $this->middleware('credential:puede_editar_roles')->only(['edit','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('protected.roles.roles');
    }

    public function getList(){

        return datatables()
            ->eloquent(Rol::query())
            ->addColumn('acctions','protected.roles.acctions')
            ->rawColumns(['acctions'])
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Author: Azael Ponce
     * Funcion : Crear Rol
     *Desccripcion: Retorna el formulario de creacion de rol...
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            //Si es ajax y metodo get retornamos un nuevo formulario vacio...
            $html=view('protected.roles.create')->render();
            return response()->json(array('valor'=>true,'html'=>$html));
        }

        // Si la peticion no es ajax levantamos un error 404 ...
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


            if($request->has('id')){
                // Si se detecta un id de rol, se hara una actualizacion del registro

            }else{
                //Si no se encuentra, se hara una insersion del registro
                //por lo cual se validan los datos recibidos
                $isValid=Validator::Make($request->all(),[
                    'name'=>'required|string|min:4|max:50|unique:tlk_roles,tt_name',
                    'desc'=>'required|string|min:6|max:250',
                    'estado'=>''
                ]);
                $band=false;
                $html='';
                if($isValid->fails()){
                    //retornamos la vista crear con correcciones;
                    $band=false;
                    $html=view('protected.roles.create')
                                        ->withErrors($isValid)
                                        ->with('name',$request->name)
                                        ->with('desc',$request->desc)
                                        ->with('estado',$request->estado)
                                        ->render();

                }else{
                    //Se crea y almacena el nuevo rol creado
                    $rol=new Rol;

                    $rol->setName($request->name);
                    $rol->setDesc($request->desc);

                    if($request->estado){
                        $rol->setState(true);
                    }else{
                        $rol->setState(false);
                    }

                    $rol->save();
                    $band=true;
                    $html="";
                }

                return response()->json(array('valor'=>$band, 'html'=>$html));
            }
        }

        //Si no es ajax levantamos un error 404
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //especificaion de funcion no establecida
        //..
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $rol=Rol::find($id);
        if($request->ajax()){
            $html=view('protected.roles.edit')
                ->with('Object',$rol)
                ->render();
            return response()->json(array('valor'=>true,'html'=>$html));
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
        if($request->ajax() && $request->method()=='PUT'){
            $band=false;
            $html='';

            //Validacion del request..........
            $val=Validator::Make($request->all(),[
                'id'=>'required|int|min:1',
                'name'=>'required|string|min:4|max:50|unique:tlk_roles,tt_name',
                'desc'=>'required|string|min:6|max:250',
                'estado'=>''
            ]);

            if($val->fails())
            {
                    $band=false;
                    $html=view('protected.roles.edit')
                        ->withErrors($val)
                        ->with('id',$request->id)
                        ->with('name',$request->name)
                        ->with('desc',$request->desc)
                        ->with('state',$request->estado)
                        ->render();

            }else{
            //Almacenamos el valor............
                $rol=Rol::find($request->id);
                $rol->setName($request->name);
                $rol->setDesc($request->desc);
                $request->estado ? $rol->setState(true):$rol->setState(false);

                $rol->save();
                $html='';
                $band=true;
            }
            return response()->json(array('valor'=>$band, 'html'=>$html));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $band=false;

        try {
            $rol=Rol::destroy($id);
            $band=true;
        }catch (\Exception $exception){
            //..
        }

        return response()->json(array('valor'=>$band));
    }
}
