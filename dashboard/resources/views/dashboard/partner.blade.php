<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Partner Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="metric-card">
                    <div class="text-indigo-500 text-sm font-semibold uppercase tracking-wider mb-1">Active Clients</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $activeClientsCount }}</div>
                </div>
                <div class="metric-card">
                    <div class="text-purple-500 text-sm font-semibold uppercase tracking-wider mb-1">Founder Slots</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $founderSlotsUsed }} <span class="text-xl text-gray-400 font-medium">/ {{ $cap }}</span></div>
                </div>
                <div class="metric-card">
                    <div class="text-emerald-500 text-sm font-semibold uppercase tracking-wider mb-1">Monthly Run-rate</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($currentMonthlyRunRate / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
                <div class="metric-card">
                    <div class="text-amber-500 text-sm font-semibold uppercase tracking-wider mb-1">Lifetime Setup Earned</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($lifetimeSetupEarned / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
            </div>

            <div class="glass-card p-0">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white/50">
                    <h3 class="text-xl font-semibold text-gray-800">My Clients</h3>
                    <a href="{{ route('clients.create') }}" class="btn-primary">Add Client</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Status</th>
                                <th>Founder?</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr>
                                <td class="font-medium text-gray-900">{{ $client->business_name }}</td>
                                <td>
                                    @if($client->status === 'active')
                                        <span class="badge-success">Active</span>
                                    @else
                                        <span class="badge-gray">{{ ucfirst($client->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($client->is_founder)
                                        <span class="badge-primary">Founder</span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('clients.show', $client) }}" class="text-indigo-600 hover:text-indigo-900 font-medium hover:underline transition-colors">View Details &rarr;</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">No clients yet. Add your first client to get started.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
