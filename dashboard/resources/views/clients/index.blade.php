<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Clients</h2>
            <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Client</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Business Name</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Founder?</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="border-b">
                            <td class="py-2">{{ $client->business_name }}</td>
                            <td class="py-2">{{ ucfirst($client->status) }}</td>
                            <td class="py-2">
                                @if($client->is_founder)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Founder</span>
                                @endif
                            </td>
                            <td class="py-2">
                                <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
