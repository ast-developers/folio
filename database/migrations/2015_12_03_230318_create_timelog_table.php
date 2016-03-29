<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("project_id")->unsigned();
            $table->integer("staff_id")->unsigned();
            $table->integer("time_spent");
            $table->date("started");
            $table->text("comment");

            $table->foreign('staff_id')
                ->references('id')
                ->on('staff')
                ->onDelete('cascade');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

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
        Schema::drop('timelog');
    }
}
