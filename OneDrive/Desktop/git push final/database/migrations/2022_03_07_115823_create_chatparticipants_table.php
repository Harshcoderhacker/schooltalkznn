<?php

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatparticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatparticipants', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Chatgroup::class);

            $table->bigInteger('chatparticipantable_id');
            $table->string('chatparticipantable_type');

            $table->uuid('uuid')->unique();
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
        Schema::dropIfExists('chatparticipants');
    }
}
