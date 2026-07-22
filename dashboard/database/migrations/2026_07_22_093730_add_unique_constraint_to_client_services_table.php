<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('client_services', function (Blueprint $table) {
            $table->unique(['client_id', 'service_id'], 'client_services_unique');
        });
    }

    public function down(): void
    {
        Schema::table('client_services', function (Blueprint $table) {
            $table->dropUnique('client_services_unique');
        });
    }
};
