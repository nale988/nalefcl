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
            $table->ipAddress('ip');         // REMOTE_ADDR
            $table->ipAddress('ip_proxy');   // HTTP_X_FORWRDED_FOR
            $table->longText('useragent');  // USER_AGENT
            $table->longText('page');       // QUERY_STRING
            $table->string('city');         // JSON
            $table->string('region');
            $table->string('country');
            $table->string('loc');
            $table->string('org');
            $table->bigInteger('user_id');
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
