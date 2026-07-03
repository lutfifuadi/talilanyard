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
        Schema::create('order_log_accessory', function (Blueprint $table) {
            $table->foreignId('order_log_id')->constrained('order_logs')->onDelete('cascade');
            $table->foreignId('accessory_id')->constrained('accessories')->onDelete('cascade');
            $table->primary(['order_log_id', 'accessory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_log_accessory');
    }
};
