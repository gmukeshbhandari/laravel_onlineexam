<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('First_Name',25);
            $table->string('Middle_Name',25)->nullable();
            $table->string('Last_Name',25);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('Previous_Password')->nullable();
            $table->string('Gender',7);
            $table->string('Country',40);
            $table->unsignedinteger('College_ID');
            $table->unsignedinteger('Symbol_No')->unique();
            $table->string('Zone',12)->nullable();
            $table->string('District',25)->nullable();
            $table->string('Village')->nullable();
            $table->string('Street_Address',60)->nullable();
            $table->unsignedtinyInteger('Ward_No')->nullable();
            $table->unsignedtinyInteger('Province_No')->nullable();
            $table->dateTime('Last_First_Name_Update');
            $table->dateTime('Last_Middle_Name_Update');
            $table->dateTime('Last_Last_Name_Update');
            $table->dateTime('Last_Password_Update');
            $table->smallInteger('No_of_Times_Name_Changed')->default('0');
            $table->smallInteger('No_of_Times_Password_Changed')->default('0');
            $table->unsignedtinyInteger('flag_one_device')->default('1');
            $table->unsignedtinyInteger('flag_en_dis')->default('1');
            $table->boolean('Verified')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
