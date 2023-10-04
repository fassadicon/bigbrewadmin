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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('method'); // 1 - cash, 2 - paymongo
            $table->text('link_id')->nullable();
            $table->text('payment_id')->nullable();
            $table->longText('url')->nullable();
            $table->decimal('amount', 10, 2);
            $table->smallInteger('status')->default(1); // 1 - pending, 2 - paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
