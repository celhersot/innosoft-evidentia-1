<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRafflesTable extends Migration
{
    protected $connection = 'base21';
    
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('prize');
            $table->foreignId('winner_id')->nullable(true);
            $table->foreignId('event_id')->nullable(false);

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
        Schema::dropIfExists('raffles');
    }
}