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
            $table->string('title',50);
            $table->string('cover_image');
            $table->string('product_code',200);
            $table->text('irrigation')->comment('الري')->nullable(); //الري
            $table->text('lighting')->comment('اضاءة')->nullable();  //اضاءة
            $table->text('temperature')->comment('درجة الحرارة')->nullable(); //درجة الحرارة
            $table->double('price',8,2);
            $table->text('description');
            $table->integer('available_in_stock')->nullable()->comment('الكمية المتوفرة في المخزن');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->foreignId('product_discount_id')->nullable();
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
