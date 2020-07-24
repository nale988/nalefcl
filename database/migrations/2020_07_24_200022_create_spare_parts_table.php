<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->string('catalogue_number')->nullable();
            $table->string('storage_number')->nullable();
            $table->string('info')->nullable();
            $table->string('spare_part_group')->nullable();
            $table->string('position')->nullable();
            $table->string('unit')->nullable();
            $table->integer('danger_level')->nullable();
            $table->boolean('critical_part')->nullable();
            $table->foreignId('spare_part_type_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('spare_parts');
    }
}
