<?php

namespace App\Services;

use App\Models\User;
use App\Models\Settings;

class ReferralService
{
    public function isFounderForPartner(User $partner): bool
    {
        $cap = Settings::current()->founder_client_cap;
        $existing = $partner->clients()->withTrashed()->count();
        return $existing < $cap;
    }
}
