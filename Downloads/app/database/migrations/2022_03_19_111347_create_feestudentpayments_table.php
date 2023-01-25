<?php

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Feesetting\Feediscount;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeestudentpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feestudentpayments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feemaster::class);
            $table->foreignIdFor(Feeassignstudent::class);

            $table->foreignIdFor(Classmaster::class);
            $table->foreignIdFor(Section::class);
            $table->foreignIdFor(Academicyear::class);
            $table->foreignIdFor(Aparent::class);
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Feediscount::class)->nullable();

            $table->double('amount_to_pay', 10, 2);
            $table->double('paying_amount', 10, 2);
            $table->double('discount_amount', 10, 2);
            $table->double('total_paid_amount', 10, 2);
            $table->double('due_amount', 10, 2);
            $table->integer('payment_mode');
            $table->string('payment_document')->nullable();
            $table->integer('type'); // 1- Admin ,2- Parent Web, 3- Parent Mobile

            $table->string('gateway_payment_id')->nullable();

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
        Schema::dropIfExists('feestudentpayments');
    }
}
