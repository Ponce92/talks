<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlk_permissions', function (Blueprint $table) {
            $table->bigIncrements('pk_id');
            $table->string('ts_name',100);
            $table->string('td_desc',750);
            $table->boolean('tb_activo');
            $table->date('tf_created_at');
            $table->date('tf_updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tlk_permissions');
    }
}
