import os

def ensure_dir(path):
    os.makedirs(os.path.dirname(path), exist_ok=True)

views = {
    "resources/views/clients/all.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Clients</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Business Name</th>
                            <th class="py-2">Partner</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b">
                            <td class="py-2">{{ $client->business_name }}</td>
                            <td class="py-2">{{ $client->partner->name }}</td>
                            <td class="py-2">{{ ucfirst($client->status) }}</td>
                            <td class="py-2">
                                <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/partners/index.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partners</h2>
            <a href="{{ route('admin.partners.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Partner</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Clients</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr class="border-b">
                            <td class="py-2">{{ $partner->name }}</td>
                            <td class="py-2">{{ $partner->email }}</td>
                            <td class="py-2">{{ $partner->clients_count }}</td>
                            <td class="py-2">{{ $partner->is_active ? 'Active' : 'Disabled' }}</td>
                            <td class="py-2">
                                <a href="{{ route('admin.partners.show', $partner) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/partners/create.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Partner</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Phone</label>
                        <input type="text" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Password</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/partners/show.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partner: {{ $partner->name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Clients</h3>
                    <a href="{{ route('admin.partners.edit', $partner) }}" class="text-blue-600 hover:underline">Edit Partner</a>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Business Name</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b">
                            <td class="py-2">{{ $client->business_name }}</td>
                            <td class="py-2">{{ ucfirst($client->status) }}</td>
                            <td class="py-2">
                                <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">View Client</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/partners/edit.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Partner: {{ $partner->name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.partners.update', $partner) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ $partner->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $partner->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Phone</label>
                        <input type="text" name="phone" value="{{ $partner->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>
                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/services/index.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Services</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($services as $service)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.services.update', $service) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex-1">
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ $service->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="flex-1">
                        <label class="block font-medium text-sm text-gray-700">Default Price (Fils)</label>
                        <input type="number" name="default_price_fils" value="{{ $service->default_price_fils }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="pt-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/admin/settings/edit.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Settings</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Partner Setup %</label>
                        <input type="number" step="0.01" name="partner_setup_pct" value="{{ $settings->partner_setup_pct }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Partner Monthly %</label>
                        <input type="number" step="0.01" name="partner_monthly_pct" value="{{ $settings->partner_monthly_pct }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Founder Discount %</label>
                        <input type="number" step="0.01" name="founder_discount_pct" value="{{ $settings->founder_discount_pct }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Founder Client Cap</label>
                        <input type="number" name="founder_client_cap" value="{{ $settings->founder_client_cap }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    
                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
""",
    "resources/views/earnings/index.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Earnings</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Monthly Run-rate</div>
                    <div class="text-3xl font-bold">{{ number_format($currentMonthlyRunRate / 100, 2) }} AED</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Lifetime Setup Earned</div>
                    <div class="text-3xl font-bold">{{ number_format($lifetimeSetupEarned / 100, 2) }} AED</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Breakdown by Client</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Client</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Setup Earned</th>
                            <th class="py-2">Monthly Cut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientEarnings as $ce)
                        <tr class="border-b">
                            <td class="py-2">{{ $ce['client']->business_name }}</td>
                            <td class="py-2">{{ ucfirst($ce['client']->status) }}</td>
                            <td class="py-2">{{ number_format($ce['setup'] / 100, 2) }} AED</td>
                            <td class="py-2">{{ number_format($ce['monthly'] / 100, 2) }} AED</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

