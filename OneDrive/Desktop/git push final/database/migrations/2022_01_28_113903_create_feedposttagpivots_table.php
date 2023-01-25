<?php

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedposttagpivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedposttagpivots', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feedpost::class);
            $table->foreignIdFor(Feedtag::class);

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
        Schema::dropIfExists('feedposttagpivots');
    }
}
