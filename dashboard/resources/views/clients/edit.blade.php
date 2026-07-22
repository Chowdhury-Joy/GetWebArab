<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('clients.show', $client) }}" class="mr-4 text-gray-400 hover:text-indigo-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Edit Client: {{ $client->business_name }}</h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card p-8">
                <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Status</label>
                        <select name="status" class="input-modern" required>
                            <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="paused" {{ $client->status == 'paused' ? 'selected' : '' }}>Paused</option>
                            <option value="cancelled" {{ $client->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Business Name</label>
                        <input type="text" name="business_name" value="{{ $client->business_name }}" class="input-modern" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Contact Name</label>
                            <input type="text" name="contact_name" value="{{ $client->contact_name }}" class="input-modern">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ $client->contact_phone }}" class="input-modern">
                        </div>
                    </div>

                    <div class="bg-gray-50/50 -mx-8 px-8 py-6 border-y border-gray-100">
                        <label class="block font-medium text-sm text-gray-700 mb-3">Active Services</label>
                        <div class="space-y-3">
                            @foreach($services as $service)
                                <label class="flex items-start cursor-pointer group">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                            class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition duration-150"
                                            {{ $client->activeServices->contains('id', $service->id) ? 'checked' : '' }}
                                            {{ $service->is_mandatory ? 'onclick="return false;"' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm flex flex-col">
                                        <span class="font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $service->name }}</span>
                                        <span class="text-gray-500">{{ number_format($service->default_price_fils / 100, 2) }} AED / month</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <a href="{{ route('clients.show', $client) }}" class="btn-secondary mr-3">Cancel</a>
                        <button type="submit" class="btn-primary">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
