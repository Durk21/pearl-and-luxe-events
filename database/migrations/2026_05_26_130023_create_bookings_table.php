<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('package_id')->constrained()->onDelete('restrict');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->date('event_date');
            $table->string('event_type');
            $table->integer('guest_count');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
                  ->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('deposit_amount', 10, 2);
            $table->boolean('deposit_paid')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};