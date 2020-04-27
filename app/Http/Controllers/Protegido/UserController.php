<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\Models\Protegido\Permission;
use App\Models\Protegido\Rol;
use App\User;
use DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('credential:puede_ver_usuarios')->only(['index']);
//        $this->middleware('credential:puede_crear_usuarios')->only(['create','store']);
//        $this->middleware('credential:puede_editar_usuarios')->only(['edit','update']);
//        $this->middleware('credential:puede_eliminar_usuarios')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $model=DB::table('roles')
                        ->join('users','roles.id','=','users.rol_id')
                        ->select('users.*','roles.cs_name as rolname')
            ->get();

            return datatables()
                ->collection($model)
                ->addColumn('acctions','protected.users.acctions')
                ->rawColumns(['acctions','rol'])
                ->toJson();
        }


        return view('protected.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $roles=Rol::where('cb_protected','<>',true)
                        ->where('cb_state','=',true)
                        ->get();

            $html=view('protected.users.create')->with('roles',$roles)->render();

            return response()->json(array('valor'=>true,'html'=>$html));
        }else{
            //error 404...
        }

    }
    
    public function store(Request $request)
    {

        if($request->ajax()){
            $isValid=Validator::Make($request->all(),[
                'name'=>'required|string|min:4|max:50|unique:users,cs_name',
                'password'=>'required|string|min:6|max:250|confirmed',
                'rol'=>'required'
            ]);

            if($isValid->fails()){
                $roles=Rol::where('cb_protected','<>',true)
                    ->where('cb_state','=',true)
                    ->get();
                $status="form_error";
                $html=view('protected.users.create')
                    ->withErrors($isValid)
                    ->with('name',$request->name)
                    ->with('rol',$request->rol)
                    ->with('estado',$request->get('estado'))
                    ->with('roles',$roles)
                    ->render();
            }else{
                $user=new User;
                $pass=bcrypt($request->get('password'));
                if($request->estado){
                    $user->setState(true);
                }else{
                    $user->setState(false);
                }
                $user->setName($request->get('name'));
                $user->setRol($request->get('rol'));
                $user->setPassword($pass);
                $user->setCreatedAt(Date::now());
                $user->setUpdatedAt(Date::now());

                $user->save();
                $status="success";

                $roles=Rol::where('cb_protected','<>',true)
                    ->where('cb_state','=',true)
                    ->get();

                $html=view('protected.users.create')->with('roles',$roles)->render();
            }

            return response()->json(array('status'=>$status, 'html'=>$html));
            //Fin de l $request->ajax() . . .
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perm=Permission::all();
        $roles=Rol::where('cb_protected','<>',true)->get();

        $rol=Rol::where('cs_name','=',$id)->get();

        return view('protected.users.edit')
            ->with('permisions',$perm)
            ->with('roles',$roles)
            ->with('Rol',$rol);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
