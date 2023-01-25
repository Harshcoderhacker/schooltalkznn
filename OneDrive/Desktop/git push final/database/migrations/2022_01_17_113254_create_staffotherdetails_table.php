<?php

use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffotherdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffotherdetails', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Staff::class);
            // $table->string('staff_uniqid')->unique();

            $table->string('doornumber')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address_lineone')->nullable();
            $table->string('address_linetwo')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('landmark')->nullable();

            $table->string('account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch')->nullable();

            $table->string('resume')->nullable();
            $table->string('degree_certificate')->nullable();
            $table->string('school_certificate')->nullable();
            $table->string('document_one')->nullable();
            $table->string('document_two')->nullable();
            $table->string('document_three')->nullable();

            $table->string('uuid');
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
        Schema::dropIfExists('staffotherdetails');
    }
}
