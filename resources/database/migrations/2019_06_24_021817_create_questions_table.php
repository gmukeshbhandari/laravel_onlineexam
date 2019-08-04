<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('College_ID');
            $table->unsignedInteger('Subject_ID');
            $table->foreign('Subject_ID')->references('id')->on('subjects')->onDelete('cascade');
            $table->text('Question');
            $table->text('Option1');
            $table->text('Option2');
            $table->text('Option3');
            $table->text('Option4');
            $table->unsignedInteger('Correct_Answer');
            $table->decimal('Marks', 6, 2);
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
        Schema::dropIfExists('questions');
    }
}
