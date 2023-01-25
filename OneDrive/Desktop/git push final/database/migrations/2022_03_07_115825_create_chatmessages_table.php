<?php

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatmessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatmessages', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Chatgroup::class);
            $table->morphs('chatmessageable');
            $table->text('body')->nullable();
            $table->integer('messagetype')->nullable(); // 1 - text 2-audio 3-video

            $table->string('uuid')->unique();
            $table->boolean('active', array(0, 1))->default(1);
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
        Schema::dropIfExists('chatmessages');
    }
}
