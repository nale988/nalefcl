<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->string('workorder')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('regulartime')->nullable();
            $table->boolean('overtime')->nullable();
            $table->boolean('vacation')->nullable();
            $table->decimal('worktime_hours')->nullable();
            $table->decimal('overtime_hours')->nullable();
            $table->decimal('freetime_hours')->nullable();
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
        Schema::dropIfExists('work_times');
    }
}
