<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('order_number')->unique();

            $table->decimal('total_amount', 15, 2);

            $table->decimal('shipping_cost', 12, 2)->default(0);

            $table->enum('status', [
                'pending',      
                'processing',   
                'shipped',      
                'delivered',   
                'cancelled'    
            ])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid', 'failed'])->default('unpaid');

            $table->string('shipping_name');
            $table->string('shipping_phone', 20);
            $table->text('shipping_address');

            $table->string('payment_method')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('order_number');
            $table->index('status');
            $table->index('created_at');

            $table->string('snap_token')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};