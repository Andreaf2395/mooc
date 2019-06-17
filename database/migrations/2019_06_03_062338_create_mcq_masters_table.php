<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMcqMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('c_id');
            $table->Integer('question_id')->nullable();
            $table->longText('question_text')->nullable();
            $table->string('option_1')->nullable();
            $table->string('option_2')->nullable();
            $table->string('option_3')->nullable();
            $table->string('option_4')->nullable();
            $table->string('option_5')->nullable();
            $table->string('correct_option')->nullable();
            $table->string('answer_explanation')->nullable();
            $table->integer('task')->nullable();
            $table->integer('tbt_phase')->default(0);
            $table->timestamps();
            $table->foreign('c_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcq_masters');
    }
}