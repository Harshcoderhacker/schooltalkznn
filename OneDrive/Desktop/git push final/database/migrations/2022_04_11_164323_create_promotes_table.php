<?php

use App\Models\Admin\Exam\Offlineexam\Exam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotes', function (Blueprint $table) {
            $table->id();

            $table->integer('promotetype_id'); //1 - promote student 2 - promote student by exam
            $table->bigInteger('fromacademicyear_id');
            $table->bigInteger('toacademicyear_id');
            $table->foreignIdFor(Exam::class)->nullable();
            $table->bigInteger('tosection_id');
            $table->json('fromsection');
            $table->bigInteger('fromclassmaster_id');
            $table->bigInteger('toclassmaster_id');

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
        Schema::dropIfExists('promotes');
    }
}
