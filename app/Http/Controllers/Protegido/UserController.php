<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\Models\Protegido\Group;
use App\Models\Protegido\Permission;
use App\Models\Protegido\Rol;
use App\User;
use DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                        ->where('roles.cb_protected','<>',true)
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

    public function create(Request $request)
    {
        if($request->ajax()){
            $roles=Rol::where('cb_protected','<>',true)
                        ->where('cb_state','=',true)
                        ->get();

            $html=view('protected.users.create')->with('roles',$roles)->render();

            return response()->json(array('status'=>"success",'html'=>$html));
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
                $status="form_errors";
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

    public function edit($id)
    {
        $perm=Permission::all();
        $roles=Rol::where('cb_protected','<>',true)->get();

        $user=User::find($id);
        $html= view('protected.users.edit')
            ->with('permisions',$perm)
            ->with('roles',$roles)
            ->with('user',$user)
            ->render();
        //-------------
        $arreglo=array(
            "html"=>$html,
            "status"=>"success"
        );

        return response()->json($arreglo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validation=Validator::Make($request->all(),[
            'name'=>['required','string','min:4','max:50',Rule::unique('users','cs_name')
                ->ignore($id,'id')],
            'rol'=>'required',
        ]);

        $user=User::find($id);
        $user->setName($request->name);
        $user->setRol($request->rol);
        if($request->estado){
        $user->setState(true);
                    }else{
            $user->setState(false);
        }

        //renderizamos los valore falle no no falle el valid
        $perm=Permission::all();
        $roles=Rol::where('cb_protected','<>',true)->get();

        if($validation->fails()){
            $status="form_errors";
            $html= view('protected.users.edit')
                ->with('permisions',$perm)
                ->withErrors($validation)
                ->with('roles',$roles)
                ->with('user',$user)
                ->render();
        }else{

            $status="success";
            $user->save();
            $html= view('protected.users.edit')
                ->with('permisions',$perm)
                ->with('roles',$roles)
                ->with('user',$user)
                ->render();
        }

        //-------------
        $arreglo=array(
            "html"=>$html,
            "status"=>$status
        );

        return response()->json($arreglo);

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

    public function getPermission($id)
    {
        $user=User::find($id);
        $groups=DB::table('permissions')
            ->select('cs_group')
            ->distinct()
            ->get();
        $permissions=Permission::where('cb_activo','<>',false)->get();

        $html=view('protected.users.permissions')
            ->with('user',$user)
            ->with('groups',$groups)
            ->with('permisions',$permissions)
            ->render();

        $res=array( "status"=>"success",
                    "html"=>$html);

        return response()->json($res);
    }

    public function syncPermission(Request $request){
        if($request->ajax()){
            try{
                $user=User::findOrFail($request->id);

                $user->permissions()->sync($request->opt);
                $resp='success';
            }catch (\Exception $e){
                $resp='error';
            }
            return response()->json(array('status'=>$resp));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\User $user
     */
    public function getGroups( User $user)
    {

        $groupsTypes=DB::table('groups')
            ->select('cs_group')
            ->distinct()
            ->get();
        $groups=Group::all();

        $html=view('protected.users.groups')
            ->with('user',$user)
            ->with('groupsTypes',$groupsTypes)
            ->with('groups',$groups)
            ->render();

        $res=array( "status"=>"success",
            "html"=>$html);

        return response()->json($res);
    }


    public function syncGroups(Request $request){
        if($request->ajax()){
            try{
                $user=User::findOrFail($request->id);

                $user->groups()->sync($request->opt);
                $resp='success';
            }catch (\Exception $e){
                $resp='error';
            }
            return response()->json(array('status'=>$resp));
        }
    }


}
