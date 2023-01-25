<?php

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Message Table
        Schema::create('homeworkcomments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Homework::class);
            $table->foreignIdFor(Homeworklist::class); // chat_id
            $table->bigInteger('homeworkcommentable_id');
            $table->string('homeworkcommentable_type');
            $table->text('body');

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
        Schema::dropIfExists('homeworkcomments');
    }
}
