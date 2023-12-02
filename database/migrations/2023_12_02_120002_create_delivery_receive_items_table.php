<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_receive_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('delivery_receive_id');
            $table->unsignedInteger('purchase_order_item_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('inventory_item_id');
            $table->decimal('quantity', 10, 2);
            $table->decimal('pending', 10, 2);
            $table->decimal('unit_measurement', 10, 2);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->unsignedSmallInteger('status')->default(1); // 1 - Pending, 2 - Incomplete, 3 - Completed
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_receive_items');
    }
};
