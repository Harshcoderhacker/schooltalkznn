<?php

use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedcomments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feedpost::class);
            $table->text('comment');
            $table->bigInteger('feedcommentable_id');
            $table->string('feedcommentable_type');
            $table->integer('commenttype'); // 0-text comment 1-stickers
            $table->string('commenttype_uuid')->nullable();

            $table->boolean('is_notstike', array(0, 1))->default(1); // Community Guidelines violation
            $table->boolean('active', array(0, 1))->default(1);
            $table->string('uuid')->unique();
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
        Schema::dropIfExists('feedcomments');
    }
}
