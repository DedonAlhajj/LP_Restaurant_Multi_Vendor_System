<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); 
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade'); 
            $table->enum('status', ['Pending', 'Accepted', 'Preparing', 'Completed', 'Rejected']); 
            $table->decimal('total_price', 8, 2); 
            $table->enum('payment_status', ['Paid', 'Unpaid']); 
            $table->string('payment_method'); 
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
};
