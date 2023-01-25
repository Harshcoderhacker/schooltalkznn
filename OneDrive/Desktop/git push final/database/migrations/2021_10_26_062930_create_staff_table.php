<?php

use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignIdFor(Staffdepartment::class);
            $table->foreignIdFor(Staffdesignation::class);

            $table->string('staff_roll_id');

            $table->string('name');
            $table->string('last_name')->nullable();

            $table->integer('role');

            $table->integer('marital_status')->nullable();

            $table->string('edf_number')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('contract_type_id')->nullable();
            $table->string('location')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');

            $table->string('api_token', 60)->unique()->nullable();

            $table->boolean('is_accountactive', array(0, 1))->default(1);

            // $table->string('doornumber')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('country')->nullable();
            // $table->string('address_lineone')->nullable();
            // $table->string('address_linetwo')->nullable();
            // $table->integer('pincode')->nullable();
            // $table->string('landmark')->nullable();

            $table->string('address', 225)->nullable();

            $table->string('father_name')->nullable();
            $table->integer('gender')->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('emerency_number')->nullable();
            $table->string('edu_qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('previous_work_experience')->nullable();
            $table->string('slack', 100)->nullable();

            $table->date('dor')->nullable(); // date of relieving
            $table->string('relieving_reason')->nullable();

            //Bank
            // $table->string('account_name')->nullable();
            // $table->string('bank_name')->nullable();
            // $table->string('account_no')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('bank_branch')->nullable();

            $table->integer('alloted_leaves')->default(12);

            $table->string('pan_no')->nullable();
            $table->string('aadhar_no')->nullable();

            $table->string('avatar')->nullable();

            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_sessionid')->nullable();

            $table->string('usertype');

            $table->text('remarks')->nullable();
            $table->string('uuid');
            $table->string('sys_id')->unique()->nullable();
            $table->string('uniqid')->unique()->nullable();
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
        Schema::dropIfExists('staff');
    }
}
