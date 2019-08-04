<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('College_Name',60);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('Previous_Password')->nullable();
            $table->string('Country',40);
            $table->string('Zone',12)->nullable();
            $table->string('District',25)->nullable();
            $table->string('Village')->nullable();
            $table->unsignedtinyInteger('Ward_No')->nullable();
            $table->unsignedtinyInteger('Province_No')->nullable();
            $table->string('Street_Address',60)->nullable();
            $table->unsignedinteger('College_ID')->unique();
            $table->dateTime('Last_College_Name_Update');
            $table->dateTime('Last_Password_Update');
            $table->smallInteger('No_of_Times_CollegeName_Changed')->default('0');
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
        Schema::dropIfExists('admins');
    }
}
