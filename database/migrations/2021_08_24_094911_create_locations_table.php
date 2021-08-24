<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['world', 'planet', 'sector', 'base', 'micro-universe'])->index();
            $table->enum('dimension', ['c-137', 'replaced', '5-126'])->index();
            $table->string('name')->index();
            $table->text('description');
            $table->unsignedBigInteger('image_id')->nullable()->index();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('locations');
    }
}
