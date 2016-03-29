<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("staff_id")->unsigned();
            $table->double("rate");
            $table->date("effective_date");
            $table->timestamps();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staff')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staff_rates');
    }
}
