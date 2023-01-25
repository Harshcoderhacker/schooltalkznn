<?php

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Academicsetting\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examsubjects', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Exam::class);
            $table->foreignIdFor(Subject::class);

            $table->boolean('is_lock', array(0, 1))->default(0);

            $table->integer('mark')->nullable();
            $table->date('examdate')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->string('note')->nullable();
            $table->date('mark_updated_at')->nullable();
            $table->date('attendance_updated_at')->nullable();

            $table->decimal('attendance_percentage')->nullable();
            $table->boolean('attendance_status', array(0, 1))->default(0);
            $table->boolean('mark_status', array(0, 1))->default(0);
            $table->integer('attendance_marked_id')->nullable();
            $table->integer('mark_marked_id')->nullable();
            $table->string('attendance_usertype')->nullable();
            $table->string('mark_usertype')->nullable();

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
        Schema::dropIfExists('examsubjects');
    }
}
