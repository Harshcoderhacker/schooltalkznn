<?php

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeemastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feemasters', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique()->index();
            $table->foreignIdFor(Classmaster::class);
            $table->integer('assigntype'); // 1-All Student 2-partial Student
            $table->json('section');
            $table->string('feeparticular_name');
            $table->double('amount', 10, 2);
            $table->date('due_date');

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
        Schema::dropIfExists('feemasters');
    }
}
