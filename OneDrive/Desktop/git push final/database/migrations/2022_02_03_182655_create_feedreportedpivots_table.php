<?php

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedreported;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedreportedpivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedreportedpivots', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feedpost::class);
            $table->foreignIdFor(Feedreported::class);
            $table->bigInteger('feedreportedpivotable_id');
            $table->string('feedreportedpivotable_type');

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
        Schema::dropIfExists('feedreportedpivots');
    }
}
