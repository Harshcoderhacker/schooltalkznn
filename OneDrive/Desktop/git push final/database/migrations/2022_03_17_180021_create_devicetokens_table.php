<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicetokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devicetokens', function (Blueprint $table) {
            $table->id();

            $table->morphs('devicetokenable');

            $table->string('token');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('manufacturer')->nullable();

            $table->boolean('active', array(0, 1))->default(1);
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
        Schema::dropIfExists('devicetokens');
    }
}
