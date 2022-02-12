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
        Schema::create('rating', function (Blueprint $table) {
            $this->down();
            
            $table->id();
            $table->bigInteger('movie_id')->unsigned()->index();
            $table->integer('rating');
            $table->text('description');
            
            $table->foreign('movie_id')
            ->references('id')
            ->on('movie')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating');
    }
};
