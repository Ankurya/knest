<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('property_type',200)->nullable();
            $table->float('property_price', 10, 2);
            $table->integer('number_of_bedroom')->nullable();
            $table->integer('number_of_bathroom')->nullable();
            $table->string('address',200)->nullable();
            $table->string('tax',200)->nullable();
            $table->string('plot_size',200)->nullable();
            $table->string('building_size',200)->nullable();
            $table->string('school_district',200)->nullable();
            $table->string('date',200)->nullable();
            $table->string('start_time',200)->nullable();
            $table->string('end_time',200)->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->nullable();
            $table->string('type',200)->nullable();
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
        Schema::dropIfExists('properties');
    }
}
