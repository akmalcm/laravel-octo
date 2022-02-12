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
        Schema::create('movies_theaters', function (Blueprint $table) {
            $this->down();

            $table->bigInteger('movie_id')->unsigned();
            $table->bigInteger('theater_id')->unsigned();
            $table->primary(['movie_id','theater_id']);

            $table->string('room_no');
            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->foreign('movie_id')
                ->references('id')
                ->on('movie')->onDelete('cascade');

            $table->foreign('theater_id')
                ->references('id')
                ->on('theater')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('movies_theaters');
    }
};
