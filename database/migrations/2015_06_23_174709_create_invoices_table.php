<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no');
            $table->integer('no_vehicle');
            $table->integer('discount');
            $table->integer('total_fee');
            $table->integer('payer_id')->unsigned();
            $table->string('invoice_from');
            $table->date('expiry_date');
            $table->longText('licensed_vehicles');
            $table->mediumText('description');
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
        Schema::drop('invoices');
    }

}
