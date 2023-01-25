<?php

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmotioncapturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotioncaptures', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);
            $table->foreignIdFor(Academicyear::class);

            $table->foreignIdFor(Aparent::class);
            $table->foreignIdFor(Student::class);

            $table->integer('emotionstatus');
            // 0-skip 1 -Happy 2-Excited 3-Neutral 4-Stressed 5-Scared
            $table->date('emotioncapturedate');

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
        Schema::dropIfExists('emotioncaptures');
    }
}
