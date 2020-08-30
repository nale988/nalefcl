<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('admin');
            $table->boolean('services_view');
            $table->boolean('services_add');
            $table->boolean('workhours_view');
            $table->boolean('workhours_add');
            $table->boolean('workorders_view');
            $table->boolean('workorders_add');
            $table->boolean('lubrications_view');
            $table->boolean('lubrications_add');
            $table->boolean('worktimes');
            $table->boolean('files_view');
            $table->boolean('files_add');
            $table->boolean('todos');
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
