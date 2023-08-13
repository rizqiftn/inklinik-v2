<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_m', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('staff_name', 100);
            $table->date('staff_dob');
            $table->string('staff_identity_number');
            $table->text('address');
            $table->smallInteger('sex');
            $table->string('phone_number', 22);
            $table->string('email', 100);
            $table->bigInteger('province_id');
            $table->bigInteger('city_id');
            $table->bigInteger('district_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('staff_m');
    }
}
