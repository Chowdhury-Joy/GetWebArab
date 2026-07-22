import os

files = {
    "app/Models/User.php": r"""<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password', 'role', 'referral_code', 'phone', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPartner(): bool
    {
        return $this->role === 'partner';
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'partner_id');
    }
}
""",
    "app/Models/Settings.php": r"""<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Support\Facades\Cache;

#[Fillable(['partner_setup_pct', 'partner_monthly_pct', 'founder_discount_pct', 'founder_client_cap'])]
class Settings extends Model
{
    public static function current(): self
    {
        return Cache::rememberForever('settings.current', function () {
            return self::firstOrCreate(
                ['id' => 1],
                [
                    'partner_setup_pct' => 40.00,
                    'partner_monthly_pct' => 25.00,
                    'founder_discount_pct' => 25.00,
                    'founder_client_cap' => 5,
                ]
            );
        });
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('settings.current');
        });
    }
}
""",
    "app/Models/Service.php": r"""<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['key', 'name', 'is_mandatory', 'default_price_fils', 'is_recurring', 'is_active', 'sort_order'])]
class Service extends Model
{
    protected function casts(): array
    {
        return [
            'is_mandatory' => 'boolean',
            'is_recurring' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_services')
            ->withPivot('price_fils', 'is_active', 'added_at', 'removed_at')
            ->withTimestamps();
    }
}
""",
    "app/Models/Client.php": r"""<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['partner_id', 'business_name', 'contact_name', 'contact_phone', 'contact_email', 'setup_fee_fils', 'is_founder', 'discount_pct_applied', 'status', 'started_at'])]
class Client extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'is_founder' => 'boolean',
            'started_at' => 'date',
        ];
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'client_services')
            ->withPivot('price_fils', 'is_active', 'added_at', 'removed_at')
            ->withTimestamps();
    }

    public function activeServices(): BelongsToMany
    {
        return $this->services()->wherePivot('is_active', true);
    }
}
""",
    "app/Models/ClientService.php": r"""<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientService extends Pivot
{
    protected $table = 'client_services';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'added_at' => 'date',
            'removed_at' => 'date',
        ];
    }
}
"""
}

for path, content in files.items():
    with open(path, "w") as out:
        out.write(content)
    print(f"Updated {path}")

