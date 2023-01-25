<?php

use App\Models\Admin\Staff\Payroll\Payroll;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrolleachmonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolleachmonths', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Staff::class);
            $table->foreignIdFor(Payroll::class);

            $table->string('month_string');

            $table->string('staff_roll_id');
            $table->string('name');
            $table->string('phone');

            $table->decimal('basic_salary', 10, 2)->default('0');
            $table->decimal('earning', 10, 2)->default('0');
            $table->decimal('deduction', 10, 2)->default('0');
            $table->decimal('gross_salary', 10, 2)->default('0');
            $table->decimal('tax', 10, 2)->default('0');
            $table->decimal('net_salary', 10, 2)->default('0');

            $table->json('earning_breakup')->nullable();
            $table->json('deduction_breakup')->nullable();
            $table->json('staff_details');

            $table->integer('no_of_days_present')->default('0');
            $table->integer('no_of_days_absent')->default('0');
            $table->integer('lop')->default('0');
            $table->integer('halfdays')->default('0');

            $table->boolean('is_generated', array(0, 1))->default(0);
            $table->boolean('is_paid', array(0, 1))->default(0);

            $table->date('payment_date')->nullable();
            $table->integer('payment_mode')->nullable();
            $table->string('payment_description')->nullable();
            $table->string('payment_doneby')->nullable();

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
        Schema::dropIfExists('payrolleachmonths');
    }
}
