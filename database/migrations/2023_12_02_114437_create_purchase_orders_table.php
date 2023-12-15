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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('supplier_id');
            $table->decimal('total_amount', 10, 2);
            $table->string('remarks')->nullable();
            // $table->unsignedSmallInteger('status')->default(1); // 1 - Pending, 2 - Incomplete, 3 - Completed
            $table->enum('status', ['Pending', 'Completed', 'Cancelled', 'Returned']); // 1 - Pending, 2 - Completed, 3- Returned
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
