<?php

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatmessagereadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatmessagereads', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Chatgroup::class);
            $table->foreignIdFor(Chatmessage::class);
            $table->bigInteger('chatmessagereadable_id');
            $table->string('chatmessagereadable_type');
            $table->timestamp('read_at')->nullable();

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
        Schema::dropIfExists('chatmessagereads');
    }
}
