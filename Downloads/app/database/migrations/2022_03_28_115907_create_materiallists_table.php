<?php

use App\Models\Admin\Material\Material;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriallistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiallists', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Material::class);
            $table->string('document_type'); //.pdf, .docx etc..,
            $table->string('document'); //path to the file

            $table->string('title');

            $table->morphs('materiallistable');

            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->string('uuid')->unique();
            $table->integer('user_id');
            $table->string('created_by');
            $table->integer('sequence_id');
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
        Schema::dropIfExists('materiallists');
    }
}
