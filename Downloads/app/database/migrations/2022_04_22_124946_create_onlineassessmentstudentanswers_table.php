<?php

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineassessmentstudentanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineassessmentstudentanswers', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Onlineassessment::class);
            $table->foreignIdFor(Onlineassessmentstudentlist::class);
            $table->foreignIdFor(Onlineassessmentquestion::class);
            $table->foreignIdFor(Student::class);
            $table->integer('answer');
            $table->boolean('is_correct')->default(0);

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
        Schema::dropIfExists('onlineassessmentstudentanswers');
    }
}
