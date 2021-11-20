<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutuals', function (Blueprint $table) {
            $table->id();
            $table->string('type',20)->comment('type = like/dislike');
            $table->unsignedBigInteger('action_on');
            $table->unsignedBigInteger('action_by');
            $table->foreign('action_on')->references('id')->on('users');
            $table->foreign('action_by')->references('id')->on('users');
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
        Schema::dropIfExists('mutuals');
    }
}
