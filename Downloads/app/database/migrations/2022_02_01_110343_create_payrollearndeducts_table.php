<?php

use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollearndeductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrollearndeducts', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Staff::class);

            $table->boolean('type'); //1-Earning or 0-Deduction
            $table->string('name');
            $table->decimal('value', 10, 2);

            $table->text('remarks')->nullable();
            $table->string('uuid')->unique();
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
        Schema::dropIfExists('payrollearndeducts');
    }
}
