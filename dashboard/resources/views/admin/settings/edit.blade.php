<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Global Settings</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Founder Client Cap</label>
                        <input type="number" name="founder_client_cap" value="{{ $settings->founder_client_cap }}" class="input-modern" required>
                        <p class="text-xs text-gray-500 mt-1">Number of clients eligible for founder discount per partner.</p>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Founder Discount Percentage (%)</label>
                        <input type="number" step="0.01" name="founder_discount_pct" value="{{ $settings->founder_discount_pct }}" class="input-modern" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Partner Setup Split (%)</label>
                        <input type="number" step="0.01" name="partner_setup_split_pct" value="{{ $settings->partner_setup_split_pct }}" class="input-modern" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Partner Monthly Split (%)</label>
                        <input type="number" step="0.01" name="partner_monthly_split_pct" value="{{ $settings->partner_monthly_split_pct }}" class="input-modern" required>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
