<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNlpdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nlpdata', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('lan');
            $table->decimal('down_votes');
            $table->decimal('up_votes');
            $table->string('sentence');
            $table->string('path');
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
        Schema::dropIfExists('nlpdata');
    }
}
