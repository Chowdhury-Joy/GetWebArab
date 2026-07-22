<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Admin Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="metric-card">
                    <div class="text-indigo-500 text-sm font-semibold uppercase tracking-wider mb-1">Total Partners</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $partners->count() }}</div>
                </div>
                <div class="metric-card">
                    <div class="text-emerald-500 text-sm font-semibold uppercase tracking-wider mb-1">Total Active Clients</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $totalActiveClients }}</div>
                </div>
                <div class="metric-card">
                    <div class="text-purple-500 text-sm font-semibold uppercase tracking-wider mb-1">Monthly House Rev</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($totalHouseMonthly / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
                <div class="metric-card">
                    <div class="text-amber-500 text-sm font-semibold uppercase tracking-wider mb-1">Monthly Payouts</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($totalPartnerPayoutsMonthly / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
            </div>
            
            <div class="glass-card p-0">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white/50">
                    <h3 class="text-xl font-semibold text-gray-800">Partners Overview</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Clients</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($partners as $partner)
                            <tr>
                                <td class="font-medium text-gray-900">{{ $partner->name }}</td>
                                <td>
                                    <span class="badge-gray">{{ $partner->clients()->count() }} clients</span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.partners.show', $partner) }}" class="text-indigo-600 hover:text-indigo-900 font-medium hover:underline transition-colors">Manage Partner &rarr;</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-500">No partners exist yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
