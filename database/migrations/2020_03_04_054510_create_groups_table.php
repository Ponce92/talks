<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tkl_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cs_name',150);
            $table->string('cs_desc')->nullable();
            $table->string('cb_state');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tkl_groups');
    }
}
