<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\Models\Protegido\Permission;
use App\Models\Protegido\Rol;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $model=User::where('cb_protected','<>',true);

            return datatables()
                ->eloquent($model)
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
                        ->where('tb_state','=',true)
                        ->get();

            $html=view('protected.users.create')->with('roles',$roles)->render();

            return response()->json(array('valor'=>true,'html'=>$html));
        }else{
            //error 404...
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
        $band=false;
        $html="";
        if($request->ajax()){
            $isValid=Validator::Make($request->all(),[
                'name'=>'required|string|min:4|max:50|unique:tlk_users,tt_name',
                'password'=>'required|string|min:6|max:250|confirmed',
                'rol'=>'required'
            ]);

            if($isValid->fails()){
                $roles=Rol::where('cb_protected','<>',true)
                    ->where('tb_state','=',true)
                    ->get();

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
                $band=true;
                $html="";
            }

            return response()->json(array('valor'=>$band, 'html'=>$html));
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

        $rol=Rol::where('tt_name','=',$id)->get();

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
