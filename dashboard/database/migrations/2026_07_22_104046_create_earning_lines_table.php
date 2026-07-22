<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('earning_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods');
            $table->foreignId('partner_id')->constrained('users');
            $table->foreignId('client_id')->constrained('clients');
            $table->enum('kind', ['setup', 'monthly']);
            
            $table->unsignedBigInteger('list_fils');
            $table->decimal('discount_pct', 5, 2);
            $table->unsignedBigInteger('charged_fils');
            $table->unsignedBigInteger('partner_fils');
            $table->unsignedBigInteger('house_fils');
            
            $table->timestamps();

            $table->index('period_id');
            $table->index('partner_id');
            $table->index(['period_id', 'partner_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('earning_lines');
    }
};
