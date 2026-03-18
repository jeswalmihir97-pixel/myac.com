<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('brand_name');
        $table->string('product_name');
         $table->string('product_image')->nullable(); // store image file name
        $table->string('product_size');
        $table->integer('product_qty');
        $table->text('product_details');
        $table->decimal('product_price', 10, 2);
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
        Schema::dropIfExists('products');
    }
}
