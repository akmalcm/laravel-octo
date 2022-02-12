<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('movies_genres', function (Blueprint $table) {
            $this->down();

            $table->bigInteger('movie_id')->unsigned()->index();
            $table->bigInteger('genre_id')->unsigned()->index();

            $table->foreign('movie_id')
                ->references('id')
                ->on('movie')->onDelete('cascade');

            $table->foreign('genre_id')
                ->references('id')
                ->on('genre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('movies_genres');
    }
};
