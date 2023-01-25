<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamifications', function (Blueprint $table) {
            $table->id();

            $table->integer('maintype'); // 1- School talks 2- School Operation
            $table->integer('subtype'); // 999-set to idealibrary (Inspirations)
            $table->integer('star');

            $table->morphs('gamificationable');
            $table->nullableMorphs('gamefunctionable');

            $table->string('flag')->nullable();
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
        Schema::dropIfExists('gamifications');
    }
}
