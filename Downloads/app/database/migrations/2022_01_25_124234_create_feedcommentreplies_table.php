<?php

use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedcommentrepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedcommentreplies', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feedpost::class);
            $table->foreignIdFor(Feedcomment::class);
            $table->text('reply');
            $table->bigInteger('feedcommentreplyable_id');
            $table->string('feedcommentreplyable_type');

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
        Schema::dropIfExists('feedcommentreplies');
    }
}
