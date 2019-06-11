<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->Integer('task_id');
            $table->Integer('status')->default(0);
            $table->decimal('total_score')->default(0);
            $table->Integer('assign_id')->nullable();
            $table->foreign('team_id')->references('team_id')->on('team_course_maps')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('assign_id')->references('id')->on('assignments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
