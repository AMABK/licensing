<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaccosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reg_id');
            $table->string('group_type');
            $table->string('name');
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('no_vehicle');
            $table->integer('yr_of_license');
            $table->date('expiry_date');
            $table->integer('fee_paid');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('saccos');
    }

}
