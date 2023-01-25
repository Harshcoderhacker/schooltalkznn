<?php

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineassessmentstudentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onlineassessmentstudentlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Onlineassessment::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);
            $table->integer('mark')->nullable();
            $table->date('participated_date')->nullable();
            $table->time('time_taken')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('assessment_status')->default(0); //0->not started 1->completed 2->In progress

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
        Schema::dropIfExists('onlineassessmentstudentlists');
    }
}
