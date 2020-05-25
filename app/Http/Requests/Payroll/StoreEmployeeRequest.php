<?php

namespace App\Http\Requests\Payroll;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nombres"=>"required|string|max:50|min:6",
            "lastName"=>"required|string|max:50|min:6",
            "birthDate"=>"date|required",
            "sexo"=>"required",
            "address"=>"required|string|min:4|max:255",
            "nit"=>"required|min:17,max:17|unique:persons,cs_nit",
            "dui"=>"required|string|min:10|max:10|unique:persons,cs_dui",
            "maritalStatus"=>"required",
            "emaill"=>"required|email|unique:persons,cs_email",

//            validacion de campos entidad empleado . . .
            "employeeCode"=>"required|string|max:10,min:3|unique:employees,cs_code",
            "entryDate"=>"required|date",
            "mail"=>"email|unique:employees,cs_email",
            "userVicidial"=>"nullable|min:2|max:30|unique:employees,cs_user_vic",
            "headsetCode"=>"nullable|min:2|max:30|unique:employees,cs_headset_code",
            "contractsTypes"=>"required",
            "parkingTypes"=>"required",
            "loker"=>"nullable|min:2|max:20",
            "biometric"=>"nullable|min:6|unique:employees,cs_biometric",
            "puestoCode"=>"required",

// Validacion de campos de referencias personales ...
            "reference1"=>"nullable|min:6|max:225",
            "reference1t"=>"nullable|required_with:reference1",
            "reference1s"=>"required_with:reference1",
            "reference2"=>"nullable|min:6|max:255",
            "reference2t"=>"nullable|required_with:reference2",
            "reference2s"=>"required_with:reference2",
            "phone1"=>"nullable|numeric",
            "phone2"=>"required_with:reference2",


        ];
    }
}
