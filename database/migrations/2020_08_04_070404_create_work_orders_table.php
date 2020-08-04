<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->string('unit')->nullable();
            $table->string('position')->nullable();
            $table->string('content')->nullable();
            $table->date('date')->nullable();
            $table->date('date1')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('preventive_maintenance')->nullable();
            $table->boolean('intervention')->nullable();
            $table->boolean('fix')->nullable();
            $table->boolean('general_repair')->nullable();
            $table->string('contractor')->nullable();
            $table->string('worker1')->nullable();
            $table->string('worker2')->nullable();
            $table->string('worker3')->nullable();
            $table->string('worker4')->nullable();
            $table->string('owner')->nullable();
            $table->string('attachment')->nullable();
            $table->string('attachment1')->nullable();
            $table->boolean('finished')->nullable();
            $table->boolean('planned')->nullable();
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
        Schema::dropIfExists('work_orders');
    }
}
