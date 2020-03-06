<?php

namespace App\Http\Controllers\Protegido;

use App\Http\Controllers\Controller;
use App\Models\Protegido\Permission;
use App\Models\Protegido\Rol;
use Illuminate\Http\Request;

class RolPermisionsController extends Controller
{
    public function index($idRol=0){
        $rol=Rol::findOrFail($idRol);

        $permissions=Permission::all();

       return  view('protected.rolPermisions.index')
                ->with('rol',$rol)
                ->with('permisions',$permissions);
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
            return response()->json(array('resp'=>$resp));
        }else{

        }

        return redirect()->route('dashboard');
    }
}
