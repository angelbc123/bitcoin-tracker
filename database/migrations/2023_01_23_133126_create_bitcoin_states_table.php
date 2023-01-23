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
        Schema::create('bitcoin_states', function (Blueprint $table) {
            $table->id();
            $table->decimal('mid', 13, 8);
            $table->decimal('bid', 13, 8);
            $table->decimal('ask', 13, 8);
            $table->decimal('last_price', 13, 8);
            $table->decimal('low', 13, 8);
            $table->decimal('high', 13, 8);
            $table->decimal('volume', 13, 8);
            $table->dateTime('valid_until');
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
        Schema::dropIfExists('bitcoin_states');
    }
};
