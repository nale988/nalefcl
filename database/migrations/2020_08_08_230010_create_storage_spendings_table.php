<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageSpendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_spendings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('storage_number')->nullable();
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('pieces')->nullable();
            $table->string('position')->nullable();
            $table->string('workorder_number')->nullable();
            $table->string('worker')->nullable();
            $table->date('date')->nullable();
            $table->string('service')->nullable();
            $table->boolean('grease')->nullable();
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
        Schema::dropIfExists('storage_spendings');
    }
}
