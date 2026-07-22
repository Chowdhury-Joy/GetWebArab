<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Partners</h2>
            <a href="{{ route('admin.partners.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Partner</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Clients</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr class="border-b">
                            <td class="py-2">{{ $partner->name }}</td>
                            <td class="py-2">{{ $partner->email }}</td>
                            <td class="py-2">{{ $partner->clients_count }}</td>
                            <td class="py-2">{{ $partner->is_active ? 'Active' : 'Disabled' }}</td>
                            <td class="py-2">
                                <a href="{{ route('admin.partners.show', $partner) }}" class="text-blue-600 hover:underline">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
