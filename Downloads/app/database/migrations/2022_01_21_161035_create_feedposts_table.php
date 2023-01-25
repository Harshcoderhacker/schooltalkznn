<?php

use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedposts', function (Blueprint $table) {
            $table->id();

            $table->text('post')->nullable();
            $table->integer('type'); // 1-New Post 2-Archivement 3- Poll
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_trimvideo', array(0, 1))->default(0);
            $table->integer('is_mediatype')->nullable(); // 0-Plain Post 1-Image 2-Video 3-Embedded youtube Video
            $table->foreignIdFor(Aparent::class)->nullable();
            $table->nullableMorphs('idealibable');

            $table->bigInteger('feedpostable_id');
            $table->string('feedpostable_type');

            $table->integer('reported_stage'); // 1-Not initiated 2-Reported 3-Approved 4-Disapproved

            $table->text('remarks')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->string('uuid')->unique();
            $table->integer('sequence_id');
            $table->integer('user_id');
            $table->string('created_by');
            $table->string('updated_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('status')->nullable();
            // $table->text('to_show')->nullable();
            $table->boolean('is_notstike', array(0, 1))->default(1); // Community Guidelines violation
            $table->boolean('active', array(0, 1))->default(1);
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('feedposts');
    }
}
