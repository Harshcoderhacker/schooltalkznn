<?php

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamstudentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examstudentlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Exam::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);

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
        Schema::dropIfExists('examstudentlists');
    }
}
