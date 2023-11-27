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
        // Schema::create('system_logs', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('loggable_id');
        //     $table->unsignedInteger('loggable_type');
        //     $table->string('message');
        //     $table->string('remarks')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
