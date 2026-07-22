<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.partners.index') }}" class="mr-4 text-gray-400 hover:text-indigo-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Add Partner</h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card p-8">
                <form action="{{ route('admin.partners.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" class="input-modern" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" class="input-modern" required>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-1">Temporary Password</label>
                        <input type="password" name="password" class="input-modern" required>
                    </div>
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="btn-primary">Create Partner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
