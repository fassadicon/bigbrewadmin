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
        Schema::create('delivery_receives', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('purchase_order_id');
            $table->unsignedInteger('user_id');
            $table->decimal('total_amount', 10, 2);
            $table->unsignedSmallInteger('status')->default(1); // 1 - Pending, 2 - Incomplete, 3 - Completed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_receives');
    }
};
