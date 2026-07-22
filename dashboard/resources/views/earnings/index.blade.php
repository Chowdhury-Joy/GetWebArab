<x-app-layout>
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
