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
use App\Models\Payroll\Retirement;
use App\Models\Payroll\RetirementType;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $query=DB::table('persons as pe')
                    ->join('employees as em','pe.id','=','em.person_id')
                    ->join('positions as po','em.cs_position_code','=','po.cs_code')
                    ->join('employee_status as es','em.employee_status_id','=','es.id')
                    ->where('es.cs_name','<>','Baja')
                    ->select(   "em.id",
                                "em.cs_code as code",
                                DB::raw('CONCAT(pe.cs_last_name,", ",pe.cs_name) as full_name'),
                                "po.cs_name as cargo",
                                "es.cs_name as estado",
                                "em.cd_entry_date as ingreso"
                            )
                    ->get();

            return datatables()
                ->collection($query)
                ->addColumn('acctions','payroll.employees.acctions')
                ->rawColumns(['acctions'])
                ->toJson();
        }


        return view('payroll.employees.employees');
    }

    public function create()
    {
        return view('payroll.employees.employee.create')
            ->with('contractsTypes',ContractTypes::all())
            ->with('maritalStatus',MaritalStatus::all())
            ->with('parkingTypes',ParkingTypes::all())
            ->with('puestos',Position::all())
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

        $employee->setPosition(Position::where('cs_code',$request->puestoCode)->first());

        $employee->setEmployeeStatus(EmployeeStatus::where('cs_name','Activo')->first());
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

                $ref->setPerson($person);
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
            dd($e->getMessage());
            DB::rollback();
            return back();
        }

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Employee  $employee
     */
    public function show(Request $request,Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Employee  $employee
     */
    public function edit(Request $request,Employee $employee)
    {
        return view('payroll.employees.employee.edit')
            ->with('contractsTypes',ContractTypes::all())
            ->with('departments',Department::all())
            ->with('positions',Position::all())
            ->with('maritalStatus',MaritalStatus::all())
            ->with('parkingTypes',ParkingTypes::all())
            ->with('relationshipTypes',RelationshipType::all())
            ->with('employeeStatus',EmployeeStatus::all())
            ->with('employee',$employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Employee  $employee
     */
    public function update(Request $request, Employee $employee)
    {
        //code here
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
    public function updateEmployee(Request $request, Employee $employee)
    {
        $validation=Validator::Make($request->all(),[
            "contractsTypes"=>"required",
            "parkingTypes"=>"required",
            "entryDate"=>"required|date",
            "mail"=>['required','email',
                Rule::unique('employees','cs_email')
                    ->ignore($employee->getId(),'id')],
            "userVicidial"=>"nullable|min:2|max:30",
            "headsetCode"=>"nullable|min:2|max:30",
            "loker"=>"nullable|min:2|max:20",
            "biometric"=>"nullable|min:6",
        ]);

        $employee->setContractType(ContractTypes::find($request->contractsTypes));
        $employee->setParkingType(ParkingTypes::find($request->parkingTypes));
        $employee->setEntryDate($request->entryDate);
        $employee->setHeadsetCode($request->headsetCode);
        $employee->setEmail($request->mail);
        $employee->setLoker($request->loker);
        $employee->setUserVic($request->userVicidial);
        $employee->setBiometric($request->biometric);


        if($validation->fails()){
            $status="form_error";
            return view('payroll.employees.employee.edit')
                ->withErrors($validation)
                ->with('employee',$employee)
                ->with('status',$status)
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('departments',Department::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('positions',Position::all())
                ->with('parkingTypes',ParkingTypes::all());
        }else{
            $status="success";
            $employee->save();

            return view('payroll.employees.employee.edit')
                ->with('employee',$employee)
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('departments',Department::all())
                ->with('positions',Position::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('status',$status)
                ->with('parkingTypes',ParkingTypes::all());
        }
    }

    public function updatePerson(Request $request, Employee $employee)
    {
        $validation=Validator::Make($request->all(),[
            "nombres"=>"required|string|max:50|min:6",
            "lastName"=>"required|string|max:50|min:6",
            "birthDate"=>"date|required",
            "sexo"=>"required",
            "address"=>"required|string|min:4|max:255",
            "nit"=>[
                'required',
                Rule::unique('persons','cs_nit')
                    ->ignore($employee->person->getId(),'id')
            ],
            "dui"=>[
                'required',
                Rule::unique('persons','cs_dui')
                    ->ignore($employee->person->getId(),'id')
            ],
            "maritalStatus"=>"required",
            "emaill"=>[
                'required',
                'email',
                Rule::unique('persons','cs_email')
                    ->ignore($employee->person->getId(),'id')
                    ]
        ]);

        $person=$employee->person;

        $person->setName($request->nombres);
        $person->setLastName($request->lastName);
        $person->setEmail($request->emaill);
        $person->setDui($request->dui);
        $person->setNit($request->nit);
        $person->setBirthDate($request->birthDate);
        $person->setSexo($request->sexo);
        $person->setAddress($request->address);
        $person->setMaritalStatus(MaritalStatus::find($request->maritalStatus));



        if($validation->fails())
        {
            $status="form_error";
            $employee->person=$person;
            return view('payroll.employees.employee.edit')
                ->withErrors($validation)
                ->with('employee',$employee)
                ->with('status',$status)
                ->with('person','person')
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('departments',Department::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('positions',Position::all())
                ->with('parkingTypes',ParkingTypes::all());
        }else{
            $status="success";
            $person->save();

            return view('payroll.employees.employee.edit')
                ->with('employee',$employee)
                ->with('employeeStatus',EmployeeStatus::all())
                ->with('maritalStatus',MaritalStatus::all())
                ->with('departments',Department::all())
                ->with('person','person')
                ->with('positions',Position::all())
                ->with('contractsTypes',ContractTypes::all())
                ->with('status',$status)
                ->with('parkingTypes',ParkingTypes::all());
        }

    }

    public function showLow(Employee $employee)
    {
        $low=new Retirement();
        $html=view('payroll.employees.employee.low')
            ->with('types',RetirementType::all())
            ->with('employee',$employee)
            ->with('low',$low)
            ->render();
        return response()->json(array('status'=>'success','html'=>$html));

    }

    public function storeLow(Request $request, Employee $employee)
    {
        $validation=Validator::Make($request->all(),[
            "type"=>"required",
            "obs"=>"required_with:rec",
            "rec"=>"",
        ]);
        $status="error";

        $low=new Retirement();

        $low->setEmployee($employee);
        $low->setObservacion($request->obs);
        $low->setRehireable($request->rec);
        if($request->type != '' && $request->type != null){
            $low->setType(RetirementType::find($request->type));
        }
        if($request->rec){
            $low->setRehireable(true);
        }else{$low->setRehireable(false);}

        if($validation->fails())
        {
            $status="form_errors";
            $html= view('payroll.employees.employee.low')
                ->withErrors($validation)
                    ->with('low',$low)
                    ->with('employee',$employee)
                    ->with('types',RetirementType::all())
                    ->render();
        }else{
            $employee->setEmployeeStatus(EmployeeStatus::where('cs_name','Baja')->first());
            $low->save();
            $employee->save();
            $status="success";
            $html='';
        }
        return response()->json(array('status'=>$status,'html'=>$html));
    }

}
