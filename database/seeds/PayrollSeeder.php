<?php

use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/*
 * Seeders de las tablas secundarias del modulo payroll
 */
        DB::table('contract_types')->insert([
            'cs_name'=>'Contrato Fijo'
        ]);
        DB::table('contract_types')->insert([
            'cs_name'=>'Servicios profecioales'
        ]);

        DB::table('employee_status')->insert([
            'cs_name'=>'Activo'
        ]);
        DB::table('employee_status')->insert([
            'cs_name'=>'Baja'
        ]);

        DB::table('marital_status')->insert([
            'cs_name'=>'Soltero',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Casado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Acompaniado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Divorciado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Viudo',
        ]);

        DB::table('parking_types')->insert([
            'cs_name'=>'Moto',
        ]);
        DB::table('parking_types')->insert([
            'cs_name'=>'Vehiculo',
        ]);

//Departamentos......................................
        DB::table('departments')->insert([
            'cs_code'=>'BI',
            'cs_name'=>'Bussiniess Inteligence',
            'cs_desc'=>'Departamento de BI'
        ]);
        DB::table('departments')->insert([
            'cs_code'=>'Smart',
            'cs_name'=>'Smart department',
            'cs_desc'=>'Departamento relacionado con smart'
        ]);
        DB::table('departments')->insert([
            'cs_code'=>'QA',
            'cs_name'=>'Quality',
            'cs_desc'=>'Departamento de QA'
        ]);
        DB::table('departments')->insert([
            'cs_code'=>'GG',
            'cs_name'=>'Gerencia General',
            'cs_desc'=>'Gerencia de la empresa'
        ]);

//Puestos .........................................
        DB::table('positions')->insert([
            'cs_code'=>'BO',
            'cs_name'=>'Back Officce',
            'cn_level'=>14,
            'cs_lob'=>'Validacion y seguimiento'
        ]);
        DB::table('positions')->insert([
            'cs_code'=>'BI',
            'cs_name'=>'Analista BI',
            'cn_level'=>7,
            'cs_lob'=>'Analisis y desarrollo'
        ]);
        DB::table('positions')->insert([
            'cs_code'=>'OPE',
            'cs_name'=>'Operador',
            'cn_level'=>15,
            'cs_lob'=>'Recepacion de llamadas'
        ]);
        DB::table('positions')->insert([
            'cs_code'=>'VAL',
            'cs_name'=>'Validador',
            'cn_level'=>14,
            'cs_lob'=>'Validacion de datos'
        ]);
        DB::table('positions')->insert([
            'cs_code'=>'SUP',
            'cs_name'=>'Supervisor',
            'cn_level'=>12,
            'cs_lob'=>'Supervisor de campania'
        ]);

        //Referencis de persona ...

        DB::table('relationship_types')->insert([
            'cs_name'=>'Hermano'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Padres'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Amigo'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Conocido'
        ]);  DB::table('relationship_types')->insert([
        'cs_name'=>'Jefe'
    ]);


    }

}
