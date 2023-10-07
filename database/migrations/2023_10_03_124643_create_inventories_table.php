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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->smallInteger('type'); // ingredient, raw (plastic cups), etc
            $table->string('measurement'); // kg, pc, tbps
            $table->decimal('stock_value', 10, 2);
            $table->decimal('warning_value', 10, 2);
            $table->smallInteger('status')->default(1); // 1 - active, 2 - inactive
            $table->longText('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
