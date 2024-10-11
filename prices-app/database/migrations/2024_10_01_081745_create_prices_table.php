<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('linkId');
            $table->integer('productId');
            $table->string('code',100)->nullable();
            $table->string('group_name',100)->nullable();
            $table->text('title')->nullable();
            $table->string('platform',150)->nullable();
            $table->string('seller',150)->nullable();
            $table->decimal('price',10,2);
            $table->decimal('price2',10,2);
            $table->decimal('cost',10,2);
            $table->string('ownership',5)->nullable();
            $table->text('link')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('prices');
    }
}
