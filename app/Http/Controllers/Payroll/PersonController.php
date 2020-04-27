<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Person $person)
    {
        if($request->ajax())
        {
//            "nombres"=>"required|string|max:50|min:6",
//            "lastName"=>"required|string|max:50|min:6",
//            "birthDate"=>"date|required",
//            "sexo"=>"required",
//            "address"=>"required|string|min:4|max:255",
//            "nit"=>"required|min:17,max:17",
//            "dui"=>"required|string|min:10|max:10",
//            "maritalStatus"=>"required",
//            "emaill"=>"required|email",

        }
        abort(405,'Metodo no soportado por el sevidor.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
