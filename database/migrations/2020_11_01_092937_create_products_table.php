<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('id_type')->nullable();
            $table->text('description');
            $table->float('unit_price',0);
            $table->double('promotion_price',0);
            $table->string('image',255);
            $table->string('unit',255);
            $table->tinyInteger('new');
            $table->timestamps(0);
        });
    }

    /**
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
