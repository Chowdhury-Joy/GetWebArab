<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Client</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    @if(auth()->user()->isAdmin())
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Partner</label>
                        <select name="partner_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }} ({{ $partner->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Business Name</label>
                        <input type="text" name="business_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Contact Name</label>
                        <input type="text" name="contact_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Phone</label>
                            <input type="text" name="contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Email</label>
                            <input type="email" name="contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Setup Fee (Fils)</label>
                        <input type="number" name="setup_fee_fils" value="80000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">Services</label>
                        @foreach($services as $service)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                    {{ $service->is_mandatory ? 'checked onclick="return false;"' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ $service->name }} ({{ number_format($service->default_price_fils / 100, 2) }} AED)</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
