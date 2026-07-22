<?php

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
