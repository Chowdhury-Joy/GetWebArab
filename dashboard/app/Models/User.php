<?php

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
class User extends Authenticatable implements \Filament\Models\Contracts\FilamentUser
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

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        if ($panel->getId() === 'partner') {
            return $this->isPartner() || $this->isAdmin();
        }

        return false;
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

    public function earningLines(): HasMany
    {
        return $this->hasMany(EarningLine::class, 'partner_id');
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class, 'partner_id');
    }

    public function earnedForPeriod(Period $period): int
    {
        return $this->earningLines()->where('period_id', $period->id)->sum('partner_fils');
    }

    public function wasPaidForPeriod(Period $period): bool
    {
        return $this->payouts()->where('period_id', $period->id)->exists();
    }
}
