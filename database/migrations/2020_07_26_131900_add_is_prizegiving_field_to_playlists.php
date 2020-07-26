<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPrizegivingFieldToPlaylists extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->json('is_prizegiving')->after('is_competition');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn('is_prizegiving');
        });
    }
}
