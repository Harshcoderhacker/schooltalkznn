<?php

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatgroups', function (Blueprint $table) {
            $table->id();

            $table->string('groupname')->nullable();
            $table->string('shortname')->nullable();
            $table->string('groupavatar')->nullable();
            $table->integer('chattype')->default(0);
            // 1-CLASSGROUP 2-SUBJECTGROUP 3-STAFFSTUDENTONETOONE 4-ADMINSTAFFONETOONE 5- ADMINSTUDENTONETOONE

            $table->foreignIdFor(Classmaster::class)->nullable();
            $table->foreignIdFor(Section::class)->nullable();

            $table->foreignIdFor(Subject::class)->nullable();
            $table->foreignIdFor(Assignsubject::class)->nullable();

            $table->foreignIdFor(Staff::class)->nullable();

            $table->json('subject_pluck')->nullable();
            $table->json('assignsubject_pluck')->nullable();
            $table->json('staff_pluck')->nullable();

            $table->string('uuid')->unique();
            $table->boolean('is_groupactive', array(0, 1))->default(1); // used
            $table->boolean('active', array(0, 1))->default(1); // not used

            $table->timestamp('lastupdated_at')->nullable();
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
        Schema::dropIfExists('chatgroups');
    }
}
