<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.periods.index') }}" class="text-gray-400 hover:text-white transition-colors">
                &larr; Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Payouts for ') }} {{ DateTime::createFromFormat('!m', $period->month)->format('F') }} {{ $period->year }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="glass-card">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-700/50">
                                <th class="p-4 text-gray-400 font-medium">Partner</th>
                                <th class="p-4 text-gray-400 font-medium text-right">Earned</th>
                                <th class="p-4 text-gray-400 font-medium">Status</th>
                                <th class="p-4 text-gray-400 font-medium">Payment Details</th>
                                <th class="p-4 text-gray-400 font-medium text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            @foreach($payoutsData as $data)
                                <tr class="hover:bg-gray-700/20 transition-colors">
                                    <td class="p-4">
                                        <div class="text-white font-medium">{{ $data->partner->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $data->partner->email }}</div>
                                    </td>
                                    <td class="p-4 text-right text-blue-400 font-medium text-lg">
                                        {{ number_format($data->earned / 100, 2) }} AED
                                    </td>
                                    <td class="p-4">
                                        @if($data->is_paid)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900/50 text-green-400 border border-green-500/30">
                                                Paid
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-900/50 text-yellow-400 border border-yellow-500/30">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-sm text-gray-300">
                                        @if($data->is_paid)
                                            <div>Date: {{ $data->payout->paid_at->format('M j, Y') }}</div>
                                            <div>Method: {{ $data->payout->method ?: 'N/A' }}</div>
                                            <div>Ref: {{ $data->payout->reference ?: 'N/A' }}</div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        @if(!$data->is_paid)
                                            <button onclick="document.getElementById('payout-form-{{ $data->partner->id }}').classList.remove('hidden')" class="text-indigo-400 hover:text-indigo-300 font-medium text-sm">
                                                Record Payment
                                            </button>
                                        @else
                                            <span class="text-gray-600 text-sm">Settled</span>
                                        @endif
                                    </td>
                                </tr>
                                
                                {{-- Inline Form for Payment --}}
                                @if(!$data->is_paid)
                                <tr id="payout-form-{{ $data->partner->id }}" class="hidden bg-gray-800/30">
                                    <td colspan="5" class="p-4">
                                        <form action="{{ route('admin.payouts.store', ['period' => $period, 'partner' => $data->partner]) }}" method="POST" class="flex flex-wrap gap-4 items-end bg-gray-900/50 p-4 rounded-lg border border-gray-700">
                                            @csrf
                                            <div class="flex-1 min-w-[150px]">
                                                <label class="block text-sm text-gray-400 mb-1">Amount (Fils)</label>
                                                <input type="number" name="amount_fils" value="{{ $data->earned }}" class="input-modern w-full bg-gray-800 border-gray-700 text-white" readonly>
                                            </div>
                                            <div class="flex-1 min-w-[150px]">
                                                <label class="block text-sm text-gray-400 mb-1">Date Paid</label>
                                                <input type="date" name="paid_at" required value="{{ date('Y-m-d') }}" class="input-modern w-full bg-gray-800 border-gray-700 text-white">
                                            </div>
                                            <div class="flex-1 min-w-[150px]">
                                                <label class="block text-sm text-gray-400 mb-1">Method (Optional)</label>
                                                <input type="text" name="method" placeholder="e.g. Bank Transfer" class="input-modern w-full bg-gray-800 border-gray-700 text-white">
                                            </div>
                                            <div class="flex-1 min-w-[150px]">
                                                <label class="block text-sm text-gray-400 mb-1">Reference (Optional)</label>
                                                <input type="text" name="reference" placeholder="e.g. TXN-12345" class="input-modern w-full bg-gray-800 border-gray-700 text-white">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn-primary py-2 px-4 whitespace-nowrap">Save</button>
                                                <button type="button" onclick="document.getElementById('payout-form-{{ $data->partner->id }}').classList.add('hidden')" class="ml-2 text-gray-400 hover:text-white text-sm">Cancel</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            
                            @if(empty($payoutsData))
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">No partner earnings to payout this month.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
