<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('position');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('year')->nullable();
            $table->string('capacity')->nullable();
            $table->string('speed')->nullable();
            $table->string('power')->nullable();
            $table->string('archive')->nullable();
            $table->string('capacity1')->nullable();
            $table->string('speed1')->nullable();
            $table->string('power1')->nullable();
            $table->string('photo')->nullable();
            $table->string('schematics')->nullable();
            $table->foreignId('device_type_id')->constrained()->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('positions');
    }
}
