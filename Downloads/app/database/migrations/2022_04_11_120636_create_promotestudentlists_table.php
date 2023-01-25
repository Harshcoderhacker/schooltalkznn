<?php

use App\Models\Admin\Promote\Promote;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotestudentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotestudentlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Promote::class);
            $table->foreignIdFor(Student::class);
            $table->integer('promotedstatus')->nullable(); // 1- promoted all/selected student 2-promote student by passing exam 3 - de-promoting student not passed the exam

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
        Schema::dropIfExists('promotestudentlists');
    }
}
