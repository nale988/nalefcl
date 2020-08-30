<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('admin')->default(0)->nullable();
            $table->boolean('spare_parts_view')->default(0)->nullable();
            $table->boolean('spare_parts_add')->default(0)->nullable();
            $table->boolean('spare_parts_order')->default(0)->nullable();
            $table->boolean('revisions_view')->default(0)->nullable();
            $table->boolean('revisions_add')->default(0)->nullable();
            $table->boolean('services_view')->default(0)->nullable();
            $table->boolean('services_add')->default(0)->nullable();
            $table->boolean('workhours_view')->default(0)->nullable();
            $table->boolean('workhours_add')->default(0)->nullable();
            $table->boolean('workorders_view')->default(0)->nullable();
            $table->boolean('workorders_add')->default(0)->nullable();
            $table->boolean('lubrications_view')->default(0)->nullable();
            $table->boolean('lubrications_add')->default(0)->nullable();
            $table->boolean('worktimes')->default(0)->nullable();
            $table->boolean('files_view')->default(0)->nullable();
            $table->boolean('files_add')->default(0)->nullable();
            $table->boolean('todos')->default(0)->nullable();
            $table->boolean('private_items')->default(0)->nullable();
            $table->boolean('favorites')->default(0)->nullable();
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
        Schema::dropIfExists('user_roles');
    }
}
