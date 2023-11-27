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
        Schema::create('size_sugar_level', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('sugar_level_id');
            $table->decimal('consumption_value', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_sugar_level');
    }
};
