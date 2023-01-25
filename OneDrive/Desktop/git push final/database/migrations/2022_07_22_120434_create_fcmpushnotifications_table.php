<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcmpushnotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcmpushnotifications', function (Blueprint $table) {
            $table->id();

            $table->string('title')->index();
            $table->string('body')->nullable();
            // $table->string('priority')->nullable();
            // $table->string('image')->nullable();
            // $table->string('icon')->nullable();
            // $table->string('sound')->nullable();
            // $table->string('clickaction_url')->nullable();
            // $table->string('color')->nullable();
            // $table->string('badge')->nullable();
            //  $table->boolean('is_notification_sent', array(0, 1))->default(0);
            $table->boolean('is_admin', array(0, 1))->default(0);
            $table->boolean('is_staff', array(0, 1))->default(0);
            $table->boolean('is_student', array(0, 1))->default(0);

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
        Schema::dropIfExists('fcmpushnotifications');
    }
}
