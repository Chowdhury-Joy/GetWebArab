<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partner: {{ $partner->name }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Clients</h3>
                    <a href="{{ route('admin.partners.edit', $partner) }}" class="text-blue-600 hover:underline">Edit Partner</a>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Business Name</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b">
                            <td class="py-2">{{ $client->business_name }}</td>
                            <td class="py-2">{{ ucfirst($client->status) }}</td>
                            <td class="py-2">
                                <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">View Client</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
