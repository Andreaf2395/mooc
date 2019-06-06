<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMemberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_member_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('login_id');
            $table->unsignedBigInteger('team_id');
            $table->string('name');
            $table->string('clg_id');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->Integer('discipline_id')->nullable();
            $table->Integer('department_id')->nullable();
            $table->Integer('year')->nullable();
            $table->string('gender')->nullable();
            $table->Integer('role');
            $table->timestamps();
            $table->foreign('team_id')->references('team_id')->on('team_course_maps')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_member_details');
    }
}
