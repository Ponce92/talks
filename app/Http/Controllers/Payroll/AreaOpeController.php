<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\AreaOperativa;
use App\Models\Payroll\Department;
use App\Models\Payroll\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use DB;

use phpDocumentor\Reflection\Types\Array_;
use PhpParser\ErrorHandler\Collecting;

class AreaOpeController extends Controller
{
    public function list(Request $request,Department $department)
    {
        if($request->ajax()){
            $model=AreaOperativa::where('cs_department_code',$department->getCode());
            return datatables()
                ->eloquent($model)
                ->addColumn('acctions','payroll.areasope.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }
    }

    public function create(Request $request,Department $department)
    {
        if($request->ajax()){

            $html=view('payroll.areasope.create')
                ->with('department',$department)
                ->with('areaope', new AreaOperativa())
                ->render();

            //--------------------
            $resp=array(
                "html"=>$html,
                "stats"=>"success",
            );
            return response()->json($resp);
        }
    }

    public function store(Request $request, Department $department)
    {
        if($request->ajax() && $request->method()=='POST') {

            $isValid = Validator::Make($request->all(), [
                'name' => 'required|string|min:4|max:50|unique:ope_areas,cs_name',
                'code' => 'required|string|min:4|max:50|unique:ope_areas,cs_code',
                'desc' => 'required|string|min:6|max:250',
                'estado' => ''
            ]);
            $area = new AreaOperativa();

            $area->setCode($request->code);
            $area->setName($request->name);
            $area->setDesc($request->desc);
            $area->setDepartment($department);

            if ($request->estado) {
                $area->setStatus(true);
            } else {
                $area->setStatus(false);
            }

            if ($isValid->fails()) {
                $status = "form_errors";
                $html = view('payroll.areasope.create')
                    ->withErrors($isValid)
                    ->with('department',$department)
                    ->with('areaope',$area)
                    ->render();

            } else {
                $area->save();
                $status = "success";
                $html = view('payroll.areasope.create')
                        ->with('areaope',new AreaOperativa())
                        ->with('department',$department)
                    ->render();
            }
            //--------------------
            $resp=array(
              "status"=>$status,
              "html"=>$html,
            );
            return response()->json($resp);
        }
    }

    //funcion requiere que se pase unarea operativa pero la url definida pasa un parametro
    // que se llama department
    public function edit(Request $request, AreaOperativa $department)
    {
            $areaOperativa=$department;//pasamos el objeto a nombre correcto...
            $dep=$areaOperativa->getDepartment();

            $html=view('payroll.areasope.edit')
                ->with('department',$dep)
                ->with('areaope', $areaOperativa)
                ->render();

            //--------------------
            $resp=array(
                "html"=>$html,
                "stats"=>"success",
            );
            return response()->json($resp);


    }

    public function update(AreaOperativa $areaOperativa)
    {

    }

    /**
     * Metodo sobre cargado department  hace referencia a un area operativa
     * en versiones posteriores separar a dos parametrs uno por objeto y sub objeto
     *
     * @param AreaOperativa $department
     */
    public function positions(AreaOperativa $department)
    {   $area=$department;
        //Corregimos loa notacon /\

        $ids=DB::table('ope_area_position')
            ->where('ope_area_id',$area->getId())
            ->select('position_id')
            ->get();

        $html=view('payroll.areasope.positions')
            ->with('area',$area)
            ->with('list',$area->positions)
            ->render();
        //--------------------
        $resp=array(
            "html"=>$html,
            "stats"=>"success",
        );
        return response()->json($resp);

    }

    /**
     * Metodo sobre cargado department  hace referencia a un area operativa
     *
     * @param AreaOperativa $department
     */
    public function alterPositions(AreaOperativa $department)
    {
        $area=$department;//corregimos la notacion...
        $related=$this->getRelatedPositions($area);

        $status="success";
        $html=view('payroll.areasope.relateds')
            ->with('area',$area)
            ->with('list',$related)
            ->render();


        $resp=array(
            "html"=>$html,
            "status"=>"success",
        );
        return response()->json($resp);

    }

    public function addPosition(int $area,int $position)
    {

        $status="success";
        $areaOperativa=AreaOperativa::find($area);
        $pos=Position::find($position);

        //------------Ligamos los nuevos valores
        DB::table('ope_area_position')
            ->insertOrIgnore(['ope_area_id'=>$areaOperativa->getId(),
                              'position_id'=>$pos->getId()
                            ]);
        //------------------------------------

        $html=view('payroll.areasope.positions')
            ->with('area',$areaOperativa)
            ->with('list',$areaOperativa->positions)
            ->render();

        $resp=array(
            "html"=>$html,
            "status"=>$status,
        );
        return response()->json($resp);

    }

    public function trashPosition(int $area,int $position){
        $status="success";
        $areaOperativa=AreaOperativa::find($area);
        $pos=Position::find($position);
    //------------Ligamos los nuevos valores
        DB::table('ope_area_position')
                    ->where('ope_area_id',$areaOperativa->getId())
                    ->where('position_id',$pos->getId())
                    ->delete();

        $html=view('payroll.areasope.positions')
            ->with('area',$areaOperativa)
            ->with('list',$areaOperativa->positions)
            ->render();
        //=======================================================
        $resp=array(
            "html"=>$html,
            "status"=>$status,
                );
        return response()->json($resp);
    }


    /**
     * Desc: La funcion retorna los puestos que aun no han sido asignados al area que recibe
     *          y que se pueden agregar
     * @param $area
     * @return mixed
     */
    protected function getRelatedPositions($area){
        $resp=Position::whereNotIn('id',function ($query) use ($area)
                                        {
                                        $query->select('position_id')
                                            ->from('ope_area_position')
                                            ->where('ope_area_id',$area->getId());
                                        })
                        ->where('cb_req_area',true)
                        ->where('cb_req_dep',false)
                        ->where('cb_req_chief',true)
                        ->get();


        return $resp;
    }
}
