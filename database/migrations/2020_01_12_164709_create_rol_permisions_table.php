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
            $table->bigIncrements('pk_id');
            $table->unsignedBigInteger('fk_rol_pk');
            $table->unsignedBigInteger('fk_permission_pk');


            $table->foreign('fk_rol_pk')
                ->references('rol_id')
                ->on('tlk_roles');

            $table->foreign('fk_permission_pk')
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
