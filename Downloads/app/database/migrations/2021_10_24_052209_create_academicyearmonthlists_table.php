<?php

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicyearmonthlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academicyearmonthlists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Academicyear::class);
            $table->date('monthdate');
            $table->integer('month');
            $table->year('year');
            $table->string('month_string');

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
        Schema::dropIfExists('academicyearmonthlists');
    }
}
