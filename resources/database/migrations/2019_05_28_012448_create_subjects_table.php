<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('College_ID');
            $table->string('Subject_Name');
            $table->unsignedInteger('Category_ID');
            $table->foreign('Category_ID')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedtinyInteger('Duration');
            $table->decimal('Full_Marks',6,2);
            $table->decimal('Pass_Marks',6,2);
            $table->date('Date_of_Exam')->nullable();
            $table->boolean('Status')->default(false);
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
        Schema::dropIfExists('subjects');
    }
}
