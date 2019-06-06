<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcqTeamIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_team_ids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('team_id');
            $table->Integer('chosen_option')->nullable();
            $table->unsignedBigInteger('mcq_master_id');
            $table->foreign('mcq_master_id')->references('id')->on('mcq_masters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcq_team_ids');
    }
}
