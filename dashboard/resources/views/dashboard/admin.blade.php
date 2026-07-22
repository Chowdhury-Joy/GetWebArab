<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Admin Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="glass-card flex justify-between items-center bg-indigo-50 border-indigo-100">
                    <div>
                        <div class="text-indigo-800 text-sm font-semibold uppercase tracking-wider mb-1">Current Open Month ({{ $openPeriod ? DateTime::createFromFormat('!m', $openPeriod->month)->format('F') : 'None' }})</div>
                        <div class="text-gray-500 text-sm">Live Estimate House Revenue</div>
                        <div class="text-3xl font-bold text-indigo-900 mt-2">{{ number_format($totalHouseMonthly / 100, 2) }} <span class="text-lg text-indigo-700 font-medium">AED</span></div>
                    </div>
                    <div>
                        <a href="{{ route('admin.periods.index') }}" class="btn-primary text-sm">Manage Periods &rarr;</a>
                    </div>
                </div>

                <div class="glass-card flex justify-between items-center {{ $unpaidPartnersCount > 0 ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-100' }}">
                    <div>
                        <div class="text-gray-800 text-sm font-semibold uppercase tracking-wider mb-1">To-Do: Payouts</div>
                        <div class="text-gray-500 text-sm">For last closed month ({{ $lastClosedPeriod ? DateTime::createFromFormat('!m', $lastClosedPeriod->month)->format('F') : 'None' }})</div>
                        <div class="text-3xl font-bold {{ $unpaidPartnersCount > 0 ? 'text-amber-700' : 'text-emerald-700' }} mt-2">
                            {{ $unpaidPartnersCount }} <span class="text-lg font-medium">partners unpaid</span>
                        </div>
                    </div>
                    @if($lastClosedPeriod)
                        <div>
                            <a href="{{ route('admin.payouts.index', $lastClosedPeriod) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">Pay Now &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

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
