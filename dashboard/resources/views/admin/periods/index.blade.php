<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Billing Periods') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="glass-card mb-8">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Current Open Period</h3>
                
                @php
                    $openPeriod = $periods->firstWhere('state', 'open');
                @endphp

                @if($openPeriod)
                    <div class="bg-gray-800/50 rounded-lg p-6 flex flex-col md:flex-row justify-between items-center">
                        <div>
                            <div class="text-3xl font-bold text-white">{{ DateTime::createFromFormat('!m', $openPeriod->month)->format('F') }} {{ $openPeriod->year }}</div>
                            <div class="text-sm text-gray-400 mt-1">Live Estimate (Not Closed)</div>
                        </div>
                        <div class="flex space-x-8 mt-4 md:mt-0 text-right">
                            <div>
                                <div class="text-sm text-gray-400 uppercase tracking-wide">House Revenue</div>
                                <div class="text-xl text-green-400 font-semibold">{{ number_format($previews[$openPeriod->id]['house_earned'] / 100, 2) }} AED</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-400 uppercase tracking-wide">Partner Payouts</div>
                                <div class="text-xl text-blue-400 font-semibold">{{ number_format($previews[$openPeriod->id]['partner_earned'] / 100, 2) }} AED</div>
                            </div>
                        </div>
                        <div class="mt-6 md:mt-0">
                            <form action="{{ route('admin.periods.close', $openPeriod) }}" method="POST" onsubmit="return confirm('Are you sure you want to close this month? This will permanently freeze all partner earnings for this month and cannot be undone.');">
                                @csrf
                                <button type="submit" class="btn-primary">
                                    Close Month
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="text-gray-400">No open period found.</div>
                @endif
            </div>

            <div class="glass-card">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Closed Months History</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-700/50">
                                <th class="p-4 text-gray-400 font-medium">Month</th>
                                <th class="p-4 text-gray-400 font-medium">Closed At</th>
                                <th class="p-4 text-gray-400 font-medium text-right">House Revenue</th>
                                <th class="p-4 text-gray-400 font-medium text-right">Partner Payouts</th>
                                <th class="p-4 text-gray-400 font-medium text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            @foreach($periods->where('state', 'closed') as $period)
                                <tr class="hover:bg-gray-700/20 transition-colors">
                                    <td class="p-4">
                                        <div class="text-white font-medium">{{ DateTime::createFromFormat('!m', $period->month)->format('F') }} {{ $period->year }}</div>
                                    </td>
                                    <td class="p-4 text-gray-300">
                                        {{ $period->closed_at->format('M j, Y H:i') }}
                                    </td>
                                    <td class="p-4 text-right text-green-400 font-medium">
                                        {{ number_format($previews[$period->id]['house_earned'] / 100, 2) }} AED
                                    </td>
                                    <td class="p-4 text-right text-blue-400 font-medium">
                                        {{ number_format($previews[$period->id]['partner_earned'] / 100, 2) }} AED
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('admin.payouts.index', $period) }}" class="text-indigo-400 hover:text-indigo-300 font-medium">
                                            View & Pay &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if($periods->where('state', 'closed')->isEmpty())
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">No closed months yet.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
