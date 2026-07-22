<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 leading-tight">Earnings Dashboard</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="metric-card bg-gradient-to-br from-emerald-500/10 to-teal-500/5">
                    <div class="text-emerald-600 text-sm font-semibold uppercase tracking-wider mb-1">Monthly Run-rate</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($currentMonthlyRunRate / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
                <div class="metric-card bg-gradient-to-br from-indigo-500/10 to-purple-500/5">
                    <div class="text-indigo-600 text-sm font-semibold uppercase tracking-wider mb-1">Lifetime Setup Earned</div>
                    <div class="text-4xl font-bold text-gray-800">{{ number_format($lifetimeSetupEarned / 100, 2) }} <span class="text-xl text-gray-400 font-medium">AED</span></div>
                </div>
            </div>

            <div class="glass-card p-0">
                <div class="p-6 border-b border-gray-100 bg-white/50">
                    <h3 class="text-xl font-semibold text-gray-800">Breakdown by Client</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Status</th>
                                <th class="text-right">Setup Earned</th>
                                <th class="text-right">Monthly Cut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientEarnings as $ce)
                            <tr>
                                <td class="font-medium text-gray-900">{{ $ce['client']->business_name }}</td>
                                <td>
                                    @if($ce['client']->status === 'active')
                                        <span class="badge-success">Active</span>
                                    @else
                                        <span class="badge-gray">{{ ucfirst($ce['client']->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-right font-semibold text-gray-700">{{ number_format($ce['setup'] / 100, 2) }} AED</td>
                                <td class="text-right font-semibold text-emerald-600">{{ number_format($ce['monthly'] / 100, 2) }} AED</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">No earnings data available yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
