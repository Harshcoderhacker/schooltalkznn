<?php

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentattendancelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentattendancelists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Studentattendance::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Academicyear::class);

            $table->boolean('is_holiday', array(0, 1))->default(0);

            $table->string('month_string'); // To say which month it belongs to

            $table->text('note')->nullable();

            $table->boolean('present', array(0, 1))->default(1); //everyone should be present in default
            $table->boolean('late', array(0, 1))->default(0); //its also called as is_permission
            $table->boolean('absent', array(0, 1))->default(0);
            $table->boolean('halfday', array(0, 1))->default(0);

            $table->uuid('uuid');
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
        Schema::dropIfExists('studentattendancelists');
    }
}
