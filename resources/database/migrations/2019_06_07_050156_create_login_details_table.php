<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',50);
            $table->string('IP_Address',43);
            $table->string('MAC_Address')->nullable();
            $table->dateTime('Login_DateandTime');
            $table->string('Login_Type',30);
            $table->string('User_Type',15);
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
        Schema::dropIfExists('login_details');
    }
}
