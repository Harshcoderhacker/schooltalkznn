<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Admin\Accounts\Fee\Feemaster;
use Illuminate\Database\Migrations\Migration;
use App\Models\Admin\Settings\Feesetting\Feeparticular;

class CreateFeemasterparticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feemasterparticulars', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Feemaster::class);
            $table->foreignIdFor(Feeparticular::class);
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
        Schema::dropIfExists('feemasterparticulars');
    }
}
