<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('profile_image')->default("");
            $table->string('name');
            $table->string('country_code');
            $table->string('phone_number');
            $table->string('city');
            $table->string('pin_code');
            $table->enum('device_type',['Ios','Android','None'])->default("None");
            $table->longText('device_token');
            $table->string('email');
            $table->string('password');
            $table->integer('is_blocked')->default(0); // 0= not block , 1=> block
            $table->integer('call_enable')->default(0); // 0=> enable, 1=> not enable
            $table->longText('refresh_token')->nullable();
            $table->integer('is_verify')->default(0);
            $table->string('verify_email_token',500)->default("");
             $table->string('deleted_at')->nullable();
            $table->string('country_name')->nullable();

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

