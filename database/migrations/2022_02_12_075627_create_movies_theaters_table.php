<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_theaters', function (Blueprint $table) {
            $this->down();
            $table->engine = "InnoDB";
            $table->bigInteger('movie_id')->unsigned()->primary();
            $table->bigInteger('theater_id')->unsigned()->primary();
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
    public function down()
    {
        Schema::dropIfExists('movies_theaters');
    }
};
