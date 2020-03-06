<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolPermisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlk_rol_permision', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('fk_rol');
            $table->unsignedBigInteger('fk_permission');


            $table->foreign('fk_rol')
                ->references('rol_id')
                ->on('tlk_roles');

            $table->foreign('fk_permission')
                ->references('pk_id')
                ->on('tlk_permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlk_rol_permision');
    }
}
