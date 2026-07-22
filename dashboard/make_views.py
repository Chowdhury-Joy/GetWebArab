import os

def ensure_dir(path):
    os.makedirs(os.path.dirname(path), exist_ok=True)

views = {
    "resources/views/dashboard/admin.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Partners</div>
                    <div class="text-3xl font-bold">{{ $partners->count() }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Active Clients</div>
                    <div class="text-3xl font-bold">{{ $totalActiveClients }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Monthly House Rev</div>
                    <div class="text-3xl font-bold">{{ number_format($totalHouseMonthly / 100, 2) }} AED</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Monthly Partner Payouts</div>
                    <div class="text-3xl font-bold">{{ number_format($totalPartnerPayoutsMonthly / 100, 2) }} AED</div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Partners</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Name</th>
                            <th class="py-2">Clients</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr class="border-b">
                            <td class="py-2">{{ $partner->name }}</td>
                            <td class="py-2">{{ $partner->clients()->count() }}</td>
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
    "resources/views/dashboard/partner.blade.php": r"""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partner Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Active Clients</div>
                    <div class="text-3xl font-bold">{{ $activeClientsCount }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Founder Slots</div>
                    <div class="text-3xl font-bold">{{ $founderSlotsUsed }} / {{ $cap }}</div>
                </div>
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
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">My Clients</h3>
                    <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Client</a>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Business Name</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Founder?</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b">
                            <td class="py-2">{{ $client->business_name }}</td>
                            <td class="py-2">{{ ucfirst($client->status) }}</td>
                            <td class="py-2">
                                @if($client->is_founder)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Founder</span>
                                @endif
                            </td>
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
"""
}

for path, content in views.items():
    ensure_dir(path)
    with open(path, "w") as out:
        out.write(content)
        print(f"Created {path}")

