<?php

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeestudentparticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feestudentparticulars', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feeassignstudent::class);
            $table->string('name');
            $table->double('amount', 10, 2);

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
        Schema::dropIfExists('feestudentparticulars');
    }
}
