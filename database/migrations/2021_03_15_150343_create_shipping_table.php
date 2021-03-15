<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->unsignedBigInteger('order_address_id');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('deliver_at')->nullable();

            $table->foreign('order_address_id')
                  ->references('id')
                  ->on('order_addresses')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping', function (Blueprint $table) {
            $table->dropForeign(['order_id_id']);
            $table->dropForeign(['order_address_id']);
        });
    }
}
