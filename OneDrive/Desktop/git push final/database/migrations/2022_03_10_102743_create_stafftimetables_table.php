<?php

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStafftimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stafftimetables', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Classroutine::class); // eg: 1,2,3,4
            $table->foreignIdFor(Staff::class);

            $table->integer('monday')->nullable(); // Assignsubject_id
            $table->integer('tuesday')->nullable();
            $table->integer('wednesday')->nullable();
            $table->integer('thursday')->nullable();
            $table->integer('friday')->nullable();
            $table->integer('saturday')->nullable();
            $table->integer('sunday')->nullable();

            $table->text('remarks')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('stafftimetables');
    }
}
