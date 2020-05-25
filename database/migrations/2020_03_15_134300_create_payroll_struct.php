<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollStruct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tablas pivote..

        Schema::create('marital_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('relationship_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('employee_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('contract_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
        Schema::create('parking_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table ->string('cs_name',50)->unique();
        });
//Tabla personas
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name');
            $table->string('cs_last_name');
            $table->boolean('cb_sexo');
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->date('cd_birth_date');
            $table->string('cs_dui',10)->unique();
            $table->string('cs_nit',17)->unique();
            $table->string('cs_address');
            $table->string('cs_email')->nullable();

            $table->foreign('marital_status_id')
                ->references('id')
                ->on('marital_status')
                ->onDelete('cascade');
        });
//Referencias personales;

        Schema::create('references', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('relationship_type_id');
            $table ->integer('cn_number');
            $table->string('cb_emergency');

            $table->foreign('relationship_type_id')
                ->references('id')
                ->on('relationship_types')
                ->onDelete('cascade');

            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('restrict');
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->string('cn_number');
            $table->string('cb_corporate');

            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('cascade');
        });

        //Tabla cargos o posisiones...
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_code')->unique();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->string('cs_name')->unique();
            $table->string('cs_desc')->nullable();
            $table->boolean('cb_req_dep');
            $table->boolean('cb_req_chief');
            $table->boolean('cb_has_subs');
            $table->boolean('cb_req_area');//requiere area

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('restrict');
        });
        //Tabla empleados. . .

        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->string('cs_code','8')->unique();
            $table->unsignedBigInteger('employee_status_id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('parking_type_id');
            $table->string('cs_position_code');


            $table->string('cs_user_vic')->nullable();
            $table->date('cd_entry_date');
            $table->date('cd_end_date')->nullable();
            $table->string('cs_headset_code')->nullable();
            $table->string('cs_email')->nullable()->unique();
            $table->string('cs_loker')->nullable();
            $table->string('cs_biometric')->nullable();


            $table->foreign('person_id')
                ->references('id')
                ->on('persons')
                ->onDelete('cascade');
            $table->foreign('cs_position_code')
                ->references('cs_code')
                ->on('positions')
                ->onDelete('cascade');

            $table->foreign('employee_status_id')
                ->references('id')
                ->on('employee_status')
                ->onDelete('cascade');

            $table->foreign('contract_type_id')
                ->references('id')
                ->on('contract_types')
                ->onDelete('cascade');

            $table->foreign('parking_type_id')
                ->references('id')
                ->on('parking_types')
                ->onDelete('cascade');
        });




        /**
         * Funcionamiendo de puestos areas y de paratamentos
         */


        Schema::create('departments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('cs_chief_code',8)->nullable();
                $table->string('cs_code',8)->unique();
                $table ->string('cs_name',255)->unique();
                $table ->string('cs_desc',500)->nullable();
        });


        Schema::create('ope_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_chief_code',8)->nullable();
            $table->string('cs_department_code',8);
            $table->string('cs_code')->unique();
            $table->string('cs_name',50)->unique();
            $table->string('cs_desc',255)->nullable();
            $table->boolean('cb_status');
        });

        Schema::create('ope_area_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ope_area_id');
            $table->unsignedBigInteger('position_id');

            $table->foreign('ope_area_id')
                ->references('id')
                ->on('ope_areas')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');
        });




        //Tabla puestos de trabajo
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_code',10)->unique();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('chief_code',10)->nullable();
            $table->boolean('cb_state');



            $table->foreign('area_id')
                ->references('id')
                ->on('ope_areas')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('cascade');

        });



        // Relacion empleado y puesto de trabajo
        Schema::create('employee_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('job_id');
            $table->date('cd_entry');
            $table->date('cd_end');
            $table->string('cs_contract_type');
            $table->boolean('cb_state');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('restrict');

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('restrict');
        });


        //
        Schema::create('retirement_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name');
        });




        Schema::create('employees_retirement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('retirement_type');
            $table->string('cs_employee_code');
            $table->string('cs_retirement')->nullable();
            $table->date('cd_entry');

            $table->foreign('cs_employee_code')
                ->references('cs_code')
                ->on('employees')
                ->onDelete('restrict');

            $table->foreign('retirement_type')
                ->references('id')
                ->on('retirement_types')
                ->onDelete('restrict');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('marital_status');
        Schema::dropIfExists('employees_retirement');
        Schema::dropIfExists('retirement_types');
        Schema::dropIfExists('ope_area_postition');
        Schema::dropIfExists('relationship_types');
        Schema::dropIfExists('employee_status');
        Schema::dropIfExists('contract_types');
        Schema::dropIfExists('parking_types');

        Schema::dropIfExists('contacts');
        Schema::dropIfExists('department_position');
        Schema::dropIfExists('employee_job');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('jobs');

    }
}
