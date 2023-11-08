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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('category_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('measurement'); // kg, pc, tbps
            $table->decimal('stock_value', 10, 2);
            $table->decimal('warning_value', 10, 2);
            $table->longText('image_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
