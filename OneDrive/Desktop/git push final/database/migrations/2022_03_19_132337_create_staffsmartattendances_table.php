<?php

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsmartattendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffsmartattendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Staff::class);
            $table->bigInteger('assingedstaff_id');

            $table->date('initiated_date')->nullable();
            $table->date('actual_date'); //May have upcoming date

            $table->string('day');

            $table->foreignIdFor(Classroutine::class);

            $table->text('remarks')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->string('uuid')->unique();
            $table->integer('sequence_id');
            $table->integer('user_id'); //Assinger Admin ID
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
        Schema::dropIfExists('staffsmartattendances');
    }
}
