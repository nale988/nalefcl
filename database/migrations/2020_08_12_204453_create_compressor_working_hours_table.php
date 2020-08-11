<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompressorWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compressor_working_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->integer('total')->nullable();
            $table->integer('loaded')->nullable();
            $table->integer('starts')->nullable();
            $table->string('comment')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('compressor_working_hours');
    }
}
