<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlk_roles', function (Blueprint $table) {
            $table->bigIncrements('rol_id');
            $table->string('tt_name',100);
            $table->boolean('tb_state');
            $table->string('tt_desc',200) ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tkl_roles');
    }
}
