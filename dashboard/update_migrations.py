import os

files = {
    "settings": """<?php
use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

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
""",
    "services": """<?php
use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->boolean('is_mandatory')->default(false);
            $table->unsignedBigInteger('default_price_fils');
            $table->boolean('is_recurring')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
""",
    "clients": """<?php
use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users');
            $table->string('business_name');
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->unsignedBigInteger('setup_fee_fils');
            $table->boolean('is_founder');
            $table->decimal('discount_pct_applied', 5, 2)->default(0);
            $table->enum('status', ['active', 'paused', 'cancelled'])->default('active');
            $table->date('started_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
""",
    "client_services": """<?php
use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('price_fils');
            $table->boolean('is_active')->default(true);
            $table->date('added_at');
            $table->date('removed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_services');
    }
};
"""
}

migration_dir = "database/migrations"
for f in os.listdir(migration_dir):
    if f.endswith(".php"):
        for key in files.keys():
            if f.endswith(f"create_{key}_table.php"):
                with open(os.path.join(migration_dir, f), "w") as out:
                    out.write(files[key])
                print(f"Updated {f}")

