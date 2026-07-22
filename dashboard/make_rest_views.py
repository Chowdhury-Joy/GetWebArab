import os

def ensure_dir(path):
    os.makedirs(os.path.dirname(path), exist_ok=True)

views = {
    "resources/views/clients/show.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Client: {{ $client->business_name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Financial Split Breakdown</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Setup (One-time)</h4>
                        <ul class="text-sm space-y-1">
                            <li>List Price: {{ number_format($split['setup']['list'] / 100, 2) }} AED</li>
                            <li>Charged: {{ number_format($split['setup']['charged'] / 100, 2) }} AED</li>
                            <li>Your Cut: <strong class="text-green-600">{{ number_format($split['setup']['partner'] / 100, 2) }} AED</strong></li>
                            <li>House: {{ number_format($split['setup']['house'] / 100, 2) }} AED</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-700 mb-2">Monthly (Recurring)</h4>
                        <ul class="text-sm space-y-1">
                            <li>List Price: {{ number_format($split['monthly']['list'] / 100, 2) }} AED</li>
                            <li>Charged: {{ number_format($split['monthly']['charged'] / 100, 2) }} AED</li>
                            <li>Your Cut: <strong class="text-green-600">{{ number_format($split['monthly']['partner'] / 100, 2) }} AED</strong></li>
                            <li>House: {{ number_format($split['monthly']['house'] / 100, 2) }} AED</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline">Edit Client</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/clients/create.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Client</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    @if(auth()->user()->isAdmin())
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Partner</label>
                        <select name="partner_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }} ({{ $partner->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Business Name</label>
                        <input type="text" name="business_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Contact Name</label>
                        <input type="text" name="contact_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Phone</label>
                            <input type="text" name="contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Email</label>
                            <input type="email" name="contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Setup Fee (Fils)</label>
                        <input type="number" name="setup_fee_fils" value="80000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">Services</label>
                        @foreach($services as $service)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                    {{ $service->is_mandatory ? 'checked onclick="return false;"' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ $service->name }} ({{ number_format($service->default_price_fils / 100, 2) }} AED)</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/clients/edit.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Client: {{ $client->business_name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="paused" {{ $client->status == 'paused' ? 'selected' : '' }}>Paused</option>
                            <option value="cancelled" {{ $client->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Business Name</label>
                        <input type="text" name="business_name" value="{{ $client->business_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Name</label>
                            <input type="text" name="contact_name" value="{{ $client->contact_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ $client->contact_phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">Active Services</label>
                        @foreach($services as $service)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                    {{ $client->activeServices->contains('id', $service->id) ? 'checked' : '' }}
                                    {{ $service->is_mandatory ? 'onclick="return false;"' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ $service->name }} ({{ number_format($service->default_price_fils / 100, 2) }} AED)</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
"""
}

for path, content in views.items():
    ensure_dir(path)
    with open(path, "w") as out:
        out.write(content)
        print(f"Created {path}")

