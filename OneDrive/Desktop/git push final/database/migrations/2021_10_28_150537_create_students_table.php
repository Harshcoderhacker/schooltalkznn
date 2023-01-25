<?php

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Academicyear::class);
            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);

            $table->integer('classmaster_section_id');
            $table->foreignIdFor(Aparent::class);
            $table->string('password');

            $table->string('api_token', 60)->unique()->nullable();

            $table->boolean('is_accountactive')->default(true); // account active or not
            $table->string('name')->index();

            $table->string('addmission_number')->unique()->nullable();
            $table->string('roll_no');
            $table->string('gender');
            $table->string('last_name')->nullable();
            $table->date('dob');
            $table->string('phone_no');
            $table->string('email');
            $table->integer('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('emis_number')->nullable();
            $table->string('address')->nullable();

            $table->string('bus_no')->nullable();
            $table->string('fee_amount')->nullable();
            $table->string('route_address')->nullable();
            $table->string('route_no')->nullable();

            $table->string('adhaar_no')->nullable();
            $table->string('photo')->nullable();
            $table->string('avatar')->nullable();

            $table->string('usertype');

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
        Schema::dropIfExists('students');
    }
}
