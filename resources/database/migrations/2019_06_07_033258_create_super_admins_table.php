<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('First_Name',25);
            $table->string('Middle_Name',25)->nullable();
            $table->string('Last_Name',25);
            $table->string('email');
            $table->string('password');
            $table->string('IP_Address')->nullable()->default('0');
            $table->string('MAC_Address')->nullable()->default('0');
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
        Schema::dropIfExists('super_admins');
    }
}
