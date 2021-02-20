<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('phone');
            $table->unsignedBigInteger('whatsapp')->nullable();
            $table->enum('gender', ['L', 'P'])->comment('L=Laki-laki,P=Perempuan');
            $table->string('picturePath')->nullable();
            $table->enum('role', ['customer', 'seller', 'administrator']);
            $table->rememberToken();
            $table->unsignedTinyInteger('status')->default(0)->comment('0=Tidak Aktif,1=Aktif,2=Banned');

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
        Schema::dropIfExists('users');
    }
}
