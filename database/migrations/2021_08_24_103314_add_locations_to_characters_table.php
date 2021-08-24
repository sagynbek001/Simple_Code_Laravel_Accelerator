<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationsToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->unsignedBigInteger('birth_location_id')->nullable()->index();
            $table->foreign('birth_location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger('current_location_id')->nullable()->index();
            $table->foreign('current_location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('birth_location_id');
            $table->dropColumn('current_location_id');
        });
    }
}
