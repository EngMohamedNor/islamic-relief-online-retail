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
      
            $table->id();
            $table->timestamp("order_date");
            $table->integer("customer_id");
            $table->string("delivery_address", 255);
            $table->string("payment_method", 255);          
            $table->decimal("total", 6, 2);
            $table->string("status", 50)->nullable();
           
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
