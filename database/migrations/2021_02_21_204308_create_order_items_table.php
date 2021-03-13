<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->decimal('unit_price', 10, 2, true);
            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');
            $table->unsignedSmallInteger('quantity');
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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['order_id']);
        });
    }
}
