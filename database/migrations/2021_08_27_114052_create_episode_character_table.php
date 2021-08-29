<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_character', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->nullable()->index();
            $table->foreignId('episode_id')->nullable()->index();
            $table->foreign('character_id')->references('id')->on('characters')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('episode_id')->references('id')->on('episodes')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::dropIfExists('episode_character');
    }
}
