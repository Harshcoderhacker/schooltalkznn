<?php

use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedpollcountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedpollcounts', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feedpost::class);
            $table->foreignIdFor(Feedpoll::class);
            $table->bigInteger('feedpollcountable_id');
            $table->string('feedpollcountable_type');

            $table->string('uuid')->unique();
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
        Schema::dropIfExists('feedpollcounts');
    }
}
