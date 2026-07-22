<?php

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
