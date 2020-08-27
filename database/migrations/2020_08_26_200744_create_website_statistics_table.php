<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_statistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip')->nullable();            // REMOTE_ADDR
            $table->ipAddress('ip_proxy')->nullable();      // HTTP_X_FORWRDED_FOR
            $table->longText('useragent')->nullable();      // USER_AGENT
            $table->boolean('mobile')->default(0);
            $table->longText('page')->nullable();           // QUERY_STRING
            $table->string('city')->nullable();             // JSON
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('loc')->nullable();
            $table->string('org')->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('website_statistics');
    }
}
