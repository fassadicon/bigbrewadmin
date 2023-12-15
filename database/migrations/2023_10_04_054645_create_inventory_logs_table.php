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
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('inventory_item_id');
            $table->string('supplier_id')->default(1);
            $table->unsignedInteger('user_id');
            $table->enum('type', ['In', 'Out', 'Waste']); // 1 - In, 2 - Out, 3 - Waste
            $table->decimal('amount', 10, 2);
            $table->decimal('old_stock', 10, 2);
            $table->decimal('new_stock', 10, 2);
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
