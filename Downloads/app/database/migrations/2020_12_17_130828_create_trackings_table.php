<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');

            $table->string('uniqid');
            $table->string('name');

            $table->string('trackmsg');
            $table->string('function');
            $table->string('sessionid');
            $table->string('type');

            $table->integer('flag')->default(0);

            $table->bigInteger('trackable_id');
            $table->string('trackable_type');

            $table->softDeletes();
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
        Schema::dropIfExists('trackings');
    }
}
