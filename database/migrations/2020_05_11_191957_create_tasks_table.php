<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('date')->nullable();
            $table->integer('approve_id')->default(1);

            $table->unsignedBigInteger('stat_id')->default(1); // id n°1 => "En attente"
            $table->unsignedBigInteger('priority_id')->default(1); // id n°1 "Sans"
            $table->unsignedBigInteger('user_id');

            $table->foreign('stat_id')->references('id')->on('stats');
            $table->foreign('priority_id')->references('id')->on('priorities');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('tasks');
    }
}
