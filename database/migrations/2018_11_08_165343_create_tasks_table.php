<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('access_token')->unique();
            $table->string('title');
            $table->integer('status')->default('0');
            $table->integer('percent')->default('0');
            $table->integer('related_project')->nullable();
            $table->integer('assigned_member');
            $table->string('assigned_member_name');
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->text('details');
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
