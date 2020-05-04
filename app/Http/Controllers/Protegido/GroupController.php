<?php

namespace App\Http\Controllers\Protegido;

use App\Models\Protegido\Group;
use App\Http\Controllers\Controller;
use App\Models\Protegido\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class GroupController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('credential:puede_crear_grupos')->only(['create','store']);
//        $this->middleware('credential:puede_editar_grupos')->only(['edit','update']);
//        $this->middleware('credential:puede_eliminar_grupos')->only(['delete']);
    }

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

    public function create(Request $request)
    {
        if($request->ajax()){

            $group=new Group();
            $html=view('protected.grupos.create')
                    ->with('group',$group)
                    ->render();
            //----------------
            $resp=array("html"=>$html,
                        "status"=>"success",
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
            'name'=>'required|string|min:4|max:50|unique:groups,cs_name',
            'desc'=>'required|string|min:6|max:250',
            'groupType'=>'required',
            'estado'=>''
        ]);
        // almacenamos los valores del request en una varible tipo grupo
        $group=new Group();
        $group->setName($request->name);
        $group->setDesc($request->desc);
        if($request->has('estado')){
            $group->setState(true);
        }else{
            $group->setState(false);
        }
        $group->setGroup($request->groupType);


        if($isValid->fails()){
            //retornamos la vista crear con correcciones;
            $status="form_errors";
            $html=view('protected.grupos.create')
                ->withErrors($isValid)
                ->with('group',$group)
                ->render();
        }else{
            $group->save();
            $status="success";

            $html=view('protected.grupos.create')
                ->withErrors($isValid)
                ->with('group',new Group())
                ->render();
        }

        //----------------------------
        $resp=array("html"=>$html,
            "status"=>$status
        );

        return response()->json($resp);
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
     */
    public function edit(Group $group)
    {
        $status="success";
        $html=view('protected.grupos.edit')
            ->with('group',$group)
            ->render();
        //--------------------
        $resp=array("status"=>$status,
                    "html"=>$html);

        return response()
                ->json($resp);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     */
    public function update(Request $request, Group $group)
    {
        $var=Validator::make($request->all(),[
            'name'=>['required','string','min:4','max:50',Rule::unique('groups','cs_name')
                                                                    ->ignore($group->getId(),'id')],
            'desc'=>'required|min:3|string|max:600',
            'groupType'=>'required',
        ]);

        $group->setName($request->name);
        $group->setDesc($request->desc);
        if($request->has('estado')){
            $group->setState(true);
        }else{
            $group->setState(false);
        }
        $group->setGroup($request->groupType);


        if($var->fails()){
            $status='form_errors';
            $html=view('protected.grupos.edit')
                ->withErrors($var)
                ->with('group',$group)
                ->render();

        }else{
            $group->save();


            $status='success';
            $html=view('protected.grupos.edit')
                ->with('group',$group)
                ->render();
        }
        //---------------------
        $resp=array("html"=>$html,
                    "status"=>$status
                    );

        return response()->json($resp);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     */
    public function getPermissions(Group $group)
    {
        $types=DB::table('permissions')
            ->select('cs_group')
            ->distinct()
            ->get();
        $permissions=Permission::where('cb_activo','<>',false)->get();

        $html=view('protected.grupos.permissions')
            ->with('group',$group)
            ->with('groups',$types)
            ->with('permisions',$permissions)
            ->render();
        $res=array( "status"=>"success",
                "html"=>$html);

        return response()->json($res);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     */
    public function syncPermissions(Request $request,Group $group)
    {

        if($request->ajax()){
            try{
                $group->permissions()->sync($request->opt);
                $resp='success';
            }catch (\Exception $e){
                $resp='error';
            }
            return response()->json(array('status'=>$resp));
        }
    }

}
