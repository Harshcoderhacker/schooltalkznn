<?php

use App\Models\Admin\Student\Student;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentappactivestudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentappactivestudents', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Aparent::class);
            $table->foreignIdFor(Student::class);

            $table->string('parenttokenid');
            $table->string('type'); //web or api
            $table->string('student_uuid');

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
        Schema::dropIfExists('parentappactivestudents');
    }
}
