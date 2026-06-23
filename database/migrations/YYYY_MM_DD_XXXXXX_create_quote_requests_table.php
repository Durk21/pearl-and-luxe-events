<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('event_type');
            $table->string('budget_min');
            $table->string('budget_max');
            $table->integer('estimated_guests')->nullable();
            $table->date('event_date')->nullable();
            $table->text('special_requirements')->nullable();
            $table->string('status')->default('pending'); // pending, reviewed, responded
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};