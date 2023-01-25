<?php

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Academicyear::class);
            $table->year('academicyear');

            $table->string('schoolname');
            $table->string('apptitle');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('code');
            $table->string('language');

            $table->string('logo');
            $table->string('favicon');

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
        Schema::dropIfExists('generalsettings');
    }
}
