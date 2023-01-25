<?php

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignsubjects', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);
            $table->foreignIdFor(Subject::class);
            $table->foreignIdFor(Staff::class)->nullable();
            $table->boolean('is_classteacher', array(0, 1))->default(0);

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
            $table->boolean('active', array(0, 1))->default(0);
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
        Schema::dropIfExists('assignsubjects');
    }
}
