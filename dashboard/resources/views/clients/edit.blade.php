<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Client: {{ $client->business_name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300" required>
                            <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="paused" {{ $client->status == 'paused' ? 'selected' : '' }}>Paused</option>
                            <option value="cancelled" {{ $client->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Business Name</label>
                        <input type="text" name="business_name" value="{{ $client->business_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Name</label>
                            <input type="text" name="contact_name" value="{{ $client->contact_name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ $client->contact_phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">Active Services</label>
                        @foreach($services as $service)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                    {{ $client->activeServices->contains('id', $service->id) ? 'checked' : '' }}
                                    {{ $service->is_mandatory ? 'onclick="return false;"' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ $service->name }} ({{ number_format($service->default_price_fils / 100, 2) }} AED)</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 border-t">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
