<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComodityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comodity_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('comodity_id')->constrained('comodities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('product_unit_id')->constrained('product_units')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('price');

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
        Schema::dropIfExists('comodity_details');
    }
}
