<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">My Clients</h2>
            <a href="{{ route('clients.create') }}" class="btn-primary">Add Client</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="glass-card p-0">
                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Status</th>
                                <th>Founder?</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr>
                                <td class="font-medium text-gray-900">{{ $client->business_name }}</td>
                                <td>
                                    @if($client->status === 'active')
                                        <span class="badge-success">Active</span>
                                    @else
                                        <span class="badge-gray">{{ ucfirst($client->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($client->is_founder)
                                        <span class="badge-primary">Founder</span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('clients.show', $client) }}" class="text-indigo-600 hover:text-indigo-900 font-medium hover:underline transition-colors">View Details &rarr;</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">No clients found. Click "Add Client" to create your first client.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
