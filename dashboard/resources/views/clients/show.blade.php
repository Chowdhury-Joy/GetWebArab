<x-app-layout>
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
