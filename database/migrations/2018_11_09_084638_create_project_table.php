<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->unique();
            $table->string('name')->unique();
            $table->string('goal');
            $table->text('details');
            $table->integer('project_manager');
            $table->integer('start_country');
            $table->string('budget')->nullable();
            $table->string('budget_needed')->nullable();
            $table->string('focused_group')->nullable();
            $table->string('project_sponsor')->nullable();
            $table->date('deadline')->nullable();
            $table->date('start_date')->nullable();
            $table->string('document')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
