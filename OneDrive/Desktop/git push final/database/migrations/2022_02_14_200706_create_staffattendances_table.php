<?php

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffattendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffattendances', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Academicyear::class);
            $table->foreignIdFor(Staffdesignation::class);

            $table->decimal('attendance_percentage')->nullable();
            $table->date('attendance_date');
            $table->integer('attendance_status')->nullable();
            $table->integer('marked_id')->nullable();
            $table->string('usertype')->nullable();
            $table->boolean('is_holiday', array(0, 1))->default(0);

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
        Schema::dropIfExists('staffattendances');
    }
}
