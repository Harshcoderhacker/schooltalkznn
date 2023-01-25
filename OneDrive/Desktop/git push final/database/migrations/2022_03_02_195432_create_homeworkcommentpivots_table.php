<?php

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworklist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkcommentpivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // participants or Conversation
        Schema::create('homeworkcommentpivots', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Homework::class);
            $table->foreignIdFor(Homeworklist::class);
            $table->foreignIdFor(Homeworkcomment::class);

            $table->bigInteger('homeworkcommentsender_id');
            $table->string('homeworkcommentsender_type');

            $table->bigInteger('homeworkcommentreceiver_id');
            $table->string('homeworkcommentreceiver_type');

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
        Schema::dropIfExists('homeworkcommentpivots');
    }
}
