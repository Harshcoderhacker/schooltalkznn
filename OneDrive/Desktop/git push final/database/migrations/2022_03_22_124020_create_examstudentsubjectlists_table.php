<?php

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Settings\Academicsetting\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamstudentsubjectlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examstudentsubjectlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Exam::class);
            $table->foreignIdFor(Examstudentlist::class);
            $table->foreignIdFor(Subject::class);
            $table->integer('mark')->default(0)->nullable();
            $table->integer('subjectmark_percentage')->default(0)->nullable();
            $table->boolean('is_pass', array(0, 1))->default(0)->nullable();
            $table->boolean('is_present', array(0, 1))->default(0);
            $table->text('note')->nullable();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('examstudentsubjectlists');
    }
}
