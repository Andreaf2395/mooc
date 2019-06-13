<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMcqScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_mcq_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->Integer('task_id');
            $table->Integer('mcq_score')->default(0);
            $table->Integer('mcq_duration')->default(0);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->foreign('team_id')->references('team_id')->on('team_course_maps')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('team_mcq_scores');
    }
}
