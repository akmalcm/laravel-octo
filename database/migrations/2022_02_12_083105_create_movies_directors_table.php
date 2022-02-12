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
        Schema::create('movies_directors', function (Blueprint $table) {
            $this->down();
            
            $table->bigInteger('movie_id')->unsigned();
            $table->bigInteger('director_id')->unsigned();
            $table->primary(['movie_id','director_id']);

            $table->foreign('movie_id')
                ->references('id')
                ->on('movie')->onDelete('cascade');

            $table->foreign('director_id')
                ->references('id')
                ->on('director')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('movies_directors');
    }
};
