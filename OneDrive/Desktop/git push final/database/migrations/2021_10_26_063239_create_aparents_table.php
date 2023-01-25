<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aparents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique(); // primary phone number
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');

            $table->string('api_token', 60)->unique()->nullable();
            $table->boolean('is_accountactive')->default(true); // account active or not
            $table->string('slack', 100)->nullable();

            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_phoneno')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_phoneno')->nullable();
            $table->string('father_office_address')->nullable();

            $table->string('current_password')->nullable();

            // $table->string('doornumber')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('country')->nullable();
            // $table->string('address_lineone')->nullable();
            // $table->string('address_linetwo')->nullable();
            // $table->integer('pincode')->nullable();
            // $table->string('landmark')->nullable();

            // $table->string('father_name')->nullable();
            // $table->integer('gender')->nullable();
            // $table->date('dob')->nullable();
            // $table->date('doj')->nullable();
            // $table->string('phone_two')->nullable();
            // $table->string('edu_qualification')->nullable();
            // $table->string('experience')->nullable();
            // $table->string('previous_work_experience')->nullable();

            // $table->date('dor')->nullable(); // date of relieving
            // $table->string('relieving_reason')->nullable();

            // $table->string('account_name')->nullable();
            // $table->string('bank_name')->nullable();
            // $table->string('account_no')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('branch')->nullable();

            // $table->string('pan_no')->nullable();
            // $table->string('aadhar_no')->nullable();

            //  $table->string('avatar')->nullable();

            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_sessionid')->nullable();

            $table->string('usertype');

            $table->text('remarks')->nullable();
            $table->string('uuid');
            $table->string('sys_id')->unique()->nullable();
            $table->string('uniqid')->unique();
            $table->integer('sequence_id')->unique()->nullable();
            $table->integer('user_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('updated_id')->nullable();
            $table->integer('status')->default(0); // unused
            $table->boolean('active', array(0, 1))->default(1);
            $table->integer('flag')->default(0); // unused

            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('aparents');
    }
}
