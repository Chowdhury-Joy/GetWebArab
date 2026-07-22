import os

files = {
    "app/Http/Controllers/ClientController.php": r"""<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Services\PricingService;
use App\Services\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index()
    {
        $clients = auth()->user()->clients()->with('activeServices')->get();
        return view('clients.index', compact('clients'));
    }

    public function all()
    {
        $clients = Client::with('partner', 'activeServices')->get();
        return view('clients.all', compact('clients'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $partners = auth()->user()->isAdmin() ? User::where('role', 'partner')->get() : [];
        return view('clients.create', compact('services', 'partners'));
    }

    public function store(Request $request, ReferralService $referralService)
    {
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'setup_fee_fils' => 'required|numeric|min:0',
            'partner_id' => auth()->user()->isAdmin() ? 'required|exists:users,id' : 'nullable',
            'services' => 'required|array',
        ]);

        $partner = auth()->user()->isAdmin() ? User::find($data['partner_id']) : auth()->user();
        
        $isFounder = $referralService->isFounderForPartner($partner);
        $discountPct = $isFounder ? \App\Models\Settings::current()->founder_discount_pct : 0;

        $client = Client::create([
            'partner_id' => $partner->id,
            'business_name' => $data['business_name'],
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
            'setup_fee_fils' => $data['setup_fee_fils'],
            'is_founder' => $isFounder,
            'discount_pct_applied' => $discountPct,
            'status' => 'active',
            'started_at' => now(),
        ]);

        $services = Service::whereIn('id', $data['services'])->get();
        foreach ($services as $service) {
            $client->services()->attach($service->id, [
                'price_fils' => $service->default_price_fils,
                'is_active' => true,
                'added_at' => now(),
            ]);
        }
        
        // Ensure website_care is added if not present, as it's mandatory
        $websiteCare = Service::where('key', 'website_care')->first();
        if ($websiteCare && !$services->contains('id', $websiteCare->id)) {
            $client->services()->attach($websiteCare->id, [
                'price_fils' => $websiteCare->default_price_fils,
                'is_active' => true,
                'added_at' => now(),
            ]);
        }

        return redirect()->route('clients.show', $client)->with('success', 'Client created successfully.');
    }

    public function show(Client $client, PricingService $pricingService)
    {
        Gate::authorize('view', $client);
        $split = $pricingService->computeForClient($client);
        return view('clients.show', compact('client', 'split'));
    }

    public function edit(Client $client)
    {
        Gate::authorize('update', $client);
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('clients.edit', compact('client', 'services'));
    }

    public function update(Request $request, Client $client)
    {
        Gate::authorize('update', $client);
        
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'status' => 'required|in:active,paused,cancelled',
            'services' => 'array',
        ]);

        $client->update([
            'business_name' => $data['business_name'],
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
            'status' => $data['status'],
        ]);

        // Sync services
        $requestedServiceIds = $data['services'] ?? [];
        
        // Always include mandatory services
        $websiteCare = Service::where('key', 'website_care')->first();
        if ($websiteCare && !in_array($websiteCare->id, $requestedServiceIds)) {
            $requestedServiceIds[] = $websiteCare->id;
        }

        $existingPivots = $client->services()->pluck('client_services.id', 'services.id')->toArray();
        $allServices = Service::whereIn('id', $requestedServiceIds)->get();

        $syncData = [];
        foreach ($allServices as $service) {
            // Keep old price if exists
            $existingPivot = $client->services()->where('services.id', $service->id)->first();
            $price = $existingPivot ? $existingPivot->pivot->price_fils : $service->default_price_fils;
            $addedAt = $existingPivot ? $existingPivot->pivot->added_at : now();
            
            $syncData[$service->id] = [
                'price_fils' => $price,
                'is_active' => true,
                'added_at' => $addedAt,
                'removed_at' => null,
            ];
        }

        // We don't detach, we mark as is_active = false for removed ones
        foreach ($existingPivots as $serviceId => $pivotId) {
            if (!in_array($serviceId, $requestedServiceIds)) {
                $existingPivot = $client->services()->where('services.id', $serviceId)->first();
                $syncData[$serviceId] = [
                    'price_fils' => $existingPivot->pivot->price_fils,
                    'is_active' => false,
                    'added_at' => $existingPivot->pivot->added_at,
                    'removed_at' => now(),
                ];
            }
        }

        $client->services()->sync($syncData);

        return redirect()->route('clients.show', $client)->with('success', 'Client updated successfully.');
    }
}
""",
    "app/Http/Controllers/PartnerController.php": r"""<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = User::where('role', 'partner')->withCount('clients')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Generate referral code
        $baseCode = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $data['name']), 0, 5));
        $referralCode = $baseCode . strtoupper(Str::random(4));

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => 'partner',
            'referral_code' => $referralCode,
        ]);

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully.');
    }

    public function show(User $partner)
    {
        abort_if(!$partner->isPartner(), 404);
        $clients = $partner->clients()->with('activeServices')->get();
        return view('admin.partners.show', compact('partner', 'clients'));
    }

    public function edit(User $partner)
    {
        abort_if(!$partner->isPartner(), 404);
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, User $partner)
    {
        abort_if(!$partner->isPartner(), 404);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$partner->id,
            'phone' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $partner->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.partners.show', $partner)->with('success', 'Partner updated successfully.');
    }
}
""",
    "app/Http/Controllers/ServiceController.php": r"""<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'default_price_fils' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $service->update([
            'name' => $data['name'],
            'default_price_fils' => $data['default_price_fils'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }
}
""",
    "app/Http/Controllers/SettingsController.php": r"""<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Settings::current();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'partner_setup_pct' => 'required|numeric|min:0|max:100',
            'partner_monthly_pct' => 'required|numeric|min:0|max:100',
            'founder_discount_pct' => 'required|numeric|min:0|max:100',
            'founder_client_cap' => 'required|integer|min:0',
        ]);

        $settings = Settings::first();
        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
""",
    "app/Http/Controllers/EarningsController.php": r"""<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PricingService;

class EarningsController extends Controller
{
    public function index(PricingService $pricingService)
    {
        $user = auth()->user();
        $clients = $user->clients()->with('activeServices')->get();

        $currentMonthlyRunRate = 0;
        $lifetimeSetupEarned = 0;
        $clientEarnings = [];

        foreach ($clients as $client) {
            $split = $pricingService->computeForClient($client);
            if ($client->status === 'active') {
                $currentMonthlyRunRate += $split['monthly']['partner'];
            }
            $lifetimeSetupEarned += $split['setup']['partner'];

            $clientEarnings[] = [
                'client' => $client,
                'setup' => $split['setup']['partner'],
                'monthly' => $split['monthly']['partner'],
            ];
        }

        return view('earnings.index', compact('currentMonthlyRunRate', 'lifetimeSetupEarned', 'clientEarnings'));
    }
}
"""
}

for path, content in files.items():
    with open(path, "w") as out:
        out.write(content)
    print(f"Updated {path}")
