<x-app-layout>
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
