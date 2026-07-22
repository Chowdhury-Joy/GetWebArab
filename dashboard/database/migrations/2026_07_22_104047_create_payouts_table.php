<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users');
            $table->foreignId('period_id')->constrained('periods');
            
            $table->unsignedBigInteger('amount_fils');
            $table->date('paid_at');
            $table->string('method')->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('created_by')->constrained('users');
            
            $table->timestamps();

            $table->unique(['partner_id', 'period_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
