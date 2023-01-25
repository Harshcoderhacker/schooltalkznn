<?php

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworklists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Homework::class);
            $table->foreignIdFor(Student::class);

            $table->integer('marks')->nullable();
            $table->boolean('homework_status', array(0, 1))->default(0);
            $table->integer('staff_homework_status')->default(1); //1- NO Submission, 2- In Progress, 3- Completed, 4- Not Completed
            $table->string('submissionfile')->nullable();
            $table->timestamp('read_at')->nullable();

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
        Schema::dropIfExists('homeworklists');
    }
}
