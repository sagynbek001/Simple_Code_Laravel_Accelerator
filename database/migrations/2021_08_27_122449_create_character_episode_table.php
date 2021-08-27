<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterEpisodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_episode', function (Blueprint $table) {
            $table->unsignedBigInteger('character_id')->nullable()->index();
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('restrict');
            $table->unsignedBigInteger('episode_id')->nullable()->index();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('restrict');
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
        Schema::dropIfExists('character_episode');
    }
}
