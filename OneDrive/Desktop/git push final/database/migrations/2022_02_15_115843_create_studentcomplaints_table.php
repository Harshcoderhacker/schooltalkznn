<?php

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Frontdesksetting\Complainttype;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentcomplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentcomplaints', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);
            $table->foreignIdFor(Academicyear::class);

            $table->foreignIdFor(Aparent::class);
            $table->foreignIdFor(Student::class);

            $table->foreignIdFor(Complainttype::class);

            $table->timestamp('complaint_date')->nullable();
            $table->string('complaint_on')->nullable();
            $table->text('reason')->nullable();

            $table->integer('take_action')->default(1);

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
        Schema::dropIfExists('studentcomplaints');
    }
}
