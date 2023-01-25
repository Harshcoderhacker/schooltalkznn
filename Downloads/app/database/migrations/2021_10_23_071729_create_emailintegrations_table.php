<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailintegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailintegrations', function (Blueprint $table) {
            $table->id();

            $table->string('provider_name')->index();
            $table->string('email_from_name')->nullable();
            $table->string('email_from_mail')->nullable();
            $table->string('email_mail_driver')->nullable();
            $table->string('email_mail_host')->nullable();
            $table->string('email_mail_port')->nullable();
            $table->string('email_mail_username')->nullable();
            $table->string('email_mail_password')->nullable();
            $table->string('email_mail_encryption')->nullable();
            $table->boolean('is_default', array(0, 1))->default(0);

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
        Schema::dropIfExists('emailintegrations');
    }
}
