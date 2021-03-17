<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('user_name');
            $table->string('password');
            $table->string('salt');
            $table->boolean('enable_2fa')->default(false);
            $table->string('two_fa_code')->nullable();
            $table->json('note_attributes')->nullable();
            $table->string('background', 20)->nullable();
            $table->string('descriptions')->nullable();
            $table->timestamps();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
