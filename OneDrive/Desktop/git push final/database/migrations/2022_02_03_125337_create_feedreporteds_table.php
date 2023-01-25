<?php

use App\Models\Admin\Auth\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedreportedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedreporteds', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->foreignIdFor(User::class);
            $table->boolean('active', array(0, 1))->default(1);
            $table->string('uuid')->unique();

            $table->text('remarks')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('updated_id')->nullable();

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
        Schema::dropIfExists('feedreporteds');
    }
}
