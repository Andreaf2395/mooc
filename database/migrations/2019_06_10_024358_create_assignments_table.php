<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('folder_name');
            $table->string('folder_ext');
            $table->string('folder_path');
            $table->dateTime('upload_date');
            $table->Integer('upload_num');
            $table->decimal('assign_score')->default(0);
            $table->string('video_link')->nullable();
            $table->BigInteger('sub_type');
            $table->foreign('sub_type')->references('id')->on('task_schedules')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
