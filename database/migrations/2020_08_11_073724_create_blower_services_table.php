<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlowerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blower_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date')->nullable();
            $table->boolean('inspection')->nullable();
            $table->boolean('filter')->nullable();
            $table->boolean('belt')->nullable();
            $table->boolean('pulley')->nullable();
            $table->boolean('oil')->nullable();
            $table->boolean('nonreturn_valve')->nullable();
            $table->boolean('element_repair')->nullable();
            $table->boolean('element_replace')->nullable();
            $table->boolean('first_start')->nullable();
            $table->boolean('other')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('blower_services');
    }
}
