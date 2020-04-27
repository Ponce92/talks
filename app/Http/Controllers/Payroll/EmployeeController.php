<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payroll\StoreEmployeeRequest;
use App\Models\Payroll\Contact;
use App\Models\Payroll\ContractTypes;
use App\Models\Payroll\Department;
use App\Models\Payroll\Employee;
use App\Models\Payroll\EmployeeStatus;
use App\Models\Payroll\MaritalStatus;
use App\Models\Payroll\ParkingTypes;
use App\Models\Payroll\Person;
use App\Models\Payroll\Position;
use App\Models\Payroll\Reference;
use App\Models\Payroll\RelationshipType;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $query=DB::select('Select * from employees');

            return datatables()
                ->collection($query)
                ->addColumn('acctions','payroll.employees.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }


        return view('payroll.employees.index');
    }

    public function create()
    {
        return view('payroll.employees.employee')
            ->with('contractsTypes',ContractTypes::all())
            ->with('maritalStatus',MaritalStatus::all())
            ->with('parkingTypes',ParkingTypes::all())
            ->with('RelationshipTypes',RelationshipType::all())
            ->with('employeeStatus',EmployeeStatus::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee=new Employee();
        $person=new Person();

        $person->setName($request->nombres);
        $person->setLastName($request->lastName);
        $person->setEmail($request->emaill);
        $person->setDui($request->dui);
        $person->setNit($request->nit);
        $person->setBirthDate($request->birthDate);
        $person->setSexo($request->sexo);
        $person->setAddress($request->address);
        $person->setMaritalStatus(MaritalStatus::find($request->maritalStatus));

        $employee->setCode($request->employeeCode);

        $employee->position_id=1;
        $employee->department_id=1;

        $employee->setEmployeeStatus(EmployeeStatus::find($request->employeeStatus));
        $employee->setContractType(ContractTypes::find($request->contractsTypes));
        $employee->setParkingType(ParkingTypes::find($request->parkingTypes));

        $employee->setUserVic($request->userVicidial);
        $employee->setEntryDate($request->entryDate);
        $employee->setEndDate($request->endDate);
        $employee->setHeadsetCode($request->headsetCode);
        $employee->setEmail($request->mail);
        $employee->setLoker($request->loker);
        $employee->setBiometric($request->biometric);

        DB::beginTransaction();
        try {
            $person->save();
            $employee->setPerson($person);
            $employee->save();

            //Contactos personales de la persona . . .
            if($request->reference1 != '')
            {
                $ref= new Reference();

                $ref->setName($request->reference1);
                $ref->setNumber($request->reference1t);
                $ref->setRelationshipType(RelationshipType::find($request->reference1s));
                $request->has('reference1c') ?  $ref->setEmergency(true):$ref->setEmergency(false);
                $ref->save();
            }

            if($request->reference2 != '')
            {

                $ref= new Reference();
                $ref->setName($request->reference2);
                $ref->setNumber($request->reference2t);
                $ref->setRelationshipType(RelationshipType::find($request->reference2s));
                $request->has('reference2c') ?  $ref->setEmergency(true):$ref->setEmergency(false);
                $ref->save();
            }

            //Contactos personales de lapersona
            if($request->phone1c!='')
            {
                $cont=new Contact();
                $cont->setNumber($request->phone1c);
                $cont->setPerson($person);
                $request->has('phone1c') ? $cont->setCorporate(true):$cont->setCorporate(false);

                $cont->save();
            }
            if($request->phone2c!='')
            {
                $cont=new Contact();
                $cont->setNumber($request->phone2c);
                $cont->setPerson($person);
                $request->has('phone2c') ? $cont->setCorporate(true):$cont->setCorporate(false);

                $cont->save();
            }
            if($request->phone3c!='')
            {
                $cont=new Contact();
                $cont->setNumber($request->phone3c);
                $cont->setPerson($person);
                $request->has('phone3c') ? $cont->setCorporate(true):$cont->setCorporate(false);
                $cont->save();
            }



            DB::commit();
        }catch (\Exception $e){
            dd($e);
            DB::rollback();
        }

        return route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Employee  $employee
     */
    public function show(Request $request,Employee $employee)
    {
        if($request->ajax()){
            $html=view('payroll.employees.employeeedit')
                ->with('contractsTypes',ContractTypes::all())
                ->with('edit','off')
                ->with('departments',Department::all())
                ->with('positions',Position::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('parkingTypes',ParkingTypes::all())
                ->with('relationshipTypes',RelationshipType::all())
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('employee',$employee)->render();

            return  response()
                ->json(array('status'=>'success','html'=>$html));
        }else{
            return view('payroll.employees.edit')
                ->with('contractsTypes',ContractTypes::all())
                ->with('edit','off')
                ->with('departments',Department::all())
                ->with('positions',Position::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('parkingTypes',ParkingTypes::all())
                ->with('RelationshipTypes',RelationshipType::all())
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('employee',$employee)
                ->with('person',$employee->person);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Employee  $employee
     */
    public function edit(Request $request,Employee $employee)
    {
        $html=view('payroll.employees.employeeedit')
            ->with('contractsTypes',ContractTypes::all())
            ->with('edit','on')
            ->with('departments',Department::all())
            ->with('positions',Position::all())
            ->with('maritalStatus',MaritalStatus::all())
            ->with('parkingTypes',ParkingTypes::all())
            ->with('relationshipTypes',RelationshipType::all())
            ->with('employeeStatus',EmployeeStatus::all())
            ->with('employee',$employee)->render();

        return  response()
            ->json(array('status'=>'success','html'=>$html));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validation=Validator::Make($request->all(),[
            "employeeStatus"=>"required",
            "employeeDepartment"=>"required",
            "employeePosition"=>"required",
            "contractsTypes"=>"required",
            "parkingTypes"=>"required",

            "entryDate"=>"required|date",
            "endDate"=>"date|nullable",
            "mail"=>"email",
            "userVicidial"=>"nullable|min:2|max:30",
            "headsetCode"=>"nullable|min:2|max:30",
            "loker"=>"nullable|min:2|max:20",
            "biometric"=>"nullable|min:6",
        ]);
        $employee->setEmployeeStatus(EmployeeStatus::find($request->employeeStatus));
        $employee->setDepartment(Department::find($request->employeeDepartment));
        $employee->setPosition(Position::find($request->employeePosition));
        $employee->setContractType(ContractTypes::find($request->contractsTypes));
        $employee->setParkingType(ParkingTypes::find($request->parkingTypes));


        $employee->setEntryDate($request->entryDate);
        $employee->setEndDate($request->endDate);
        $employee->setHeadsetCode($request->headsetCode);
        $employee->setEmail($request->mail);
        $employee->setLoker($request->loker);
        $employee->setUserVic($request->userVicidial);
        $employee->setBiometric($request->biometric);


        if($validation->fails()){
            $status="form_error";
            $html=view('payroll.employees.employeeedit')
                ->withErrors($validation)
                ->with('edit','on')
                ->with('employee',$employee)
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('departments',Department::all())
                ->with('positions',Position::all())
                ->with('parkingTypes',ParkingTypes::all())
                ->render();
        }else{
            $status="success";
            $html="";
            $employee->save();

            $html=view('payroll.employees.employeeedit')
                ->with('edit','off')
                ->with('employee',$employee)
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('departments',Department::all())
                ->with('positions',Position::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('parkingTypes',ParkingTypes::all())
                ->render();
        }

        return response()->json(array('status'=>$status,'html'=>$html));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function getOnlyEmployee($id){
        $employee=Employee::find($id);
        $html=view('payroll.departments.create')
            ->render();
        return response()->json(array('status'=>'success','html'=>$html));

    }

}
