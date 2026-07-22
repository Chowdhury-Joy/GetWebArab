<?php

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
