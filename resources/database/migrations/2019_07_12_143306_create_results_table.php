<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',50)->index();
            $table->foreign('email')->references('Email')->on('users')->onDelete('cascade');
            $table->unsignedInteger('Subject_ID');
            $table->string('Subject_Name');
            $table->string('Category_Name');
            $table->date('Exam_Date');
            $table->boolean('Result');
            $table->decimal('Full_Marks',6,2);
            $table->decimal('Pass_Marks',6,2);
            $table->decimal('Obtained_Marks', 6, 2);
            $table->unsignedSmallInteger('No_of_Correct_Answer');
            $table->unsignedSmallInteger('No_of_Incorrect_Answer');
            $table->unsignedSmallInteger('No_of_Leaved_Answer');
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
        Schema::dropIfExists('results');
    }
}
