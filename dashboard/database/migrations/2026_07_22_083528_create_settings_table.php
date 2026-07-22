<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('partner_setup_pct', 5, 2)->default(40.00);
            $table->decimal('partner_monthly_pct', 5, 2)->default(25.00);
            $table->decimal('founder_discount_pct', 5, 2)->default(25.00);
            $table->unsignedInteger('founder_client_cap')->default(5);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
