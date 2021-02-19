<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('seller_id')->constrained('sellers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('address_id')->nullable()->constrained('addresses')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('order_at');
            $table->timestamp('expire_at');
            $table->unsignedTinyInteger('status')->default(0)->comment('0=Menunggu Pembayaran,1=Konfirmasi Seller,2=Diproses,3=Dikirim,4=Diterima,5=Review,6=Selesai,7=Dibatalkan');

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
        Schema::dropIfExists('orders');
    }
}
