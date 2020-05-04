<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\Models\Protegido\Permission;
use App\Models\Protegido\Rol;
use Illuminate\Http\Request;
use DB;

class RolPermisionsController extends Controller
{
    public function index($idRol=0){
        $rol=Rol::findOrFail($idRol);
        $groups=DB::table('permissions')
                    ->select('cs_group')
                    ->distinct()
                    ->get();

        $permissions=Permission::where('cb_activo','<>',false)->get();
        $html=view('protected.roles.permissions')
            ->with('rol',$rol)
            ->with('groups',$groups)
            ->with('permisions',$permissions)
            ->render();
        $res=array( "status"=>"success",
                    "html"=>$html);

        return response()->json($res);

    }

    public function update(Request $request){
        if($request->ajax()){
            /**
             * Eliminamos los permisos antes asociados al rol.
             * Almacenamos los permisos que se asignaron al rol...
            */
            try{
                $rol=Rol::findOrFail($request->id);

                $rol->permissions()->sync($request->opt);
                $resp='success';
            }catch (\Exception $e){
                $resp='error';
            }
            return response()->json(array('status'=>$resp));
        }
        return redirect()->route('dashboard');
    }
}
