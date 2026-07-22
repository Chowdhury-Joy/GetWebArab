<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="mr-4 text-gray-400 hover:text-indigo-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-600 leading-tight">Client: {{ $client->business_name }}</h2>
            </div>
            <a href="{{ route('clients.edit', $client) }}" class="btn-primary">Edit Client</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="glass-card p-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Financial Split Breakdown</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                        <h4 class="font-semibold text-gray-700 mb-4 uppercase tracking-wider text-sm flex items-center">
                            <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2"></span> Setup (One-time)
                        </h4>
                        <ul class="text-sm space-y-3">
                            <li class="flex justify-between">
                                <span class="text-gray-500">List Price:</span>
                                <span class="font-medium text-gray-900">{{ number_format($split['setup']['list'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between pb-3 border-b border-gray-200">
                                <span class="text-gray-500">Charged:</span>
                                <span class="font-medium text-gray-900">{{ number_format($split['setup']['charged'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between pt-1">
                                <span class="text-gray-900 font-semibold">Your Cut:</span>
                                <span class="font-bold text-emerald-600">{{ number_format($split['setup']['partner'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-500">House:</span>
                                <span class="font-medium text-gray-600">{{ number_format($split['setup']['house'] / 100, 2) }} AED</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-gray-50/50 p-6 rounded-xl border border-gray-100">
                        <h4 class="font-semibold text-gray-700 mb-4 uppercase tracking-wider text-sm flex items-center">
                            <span class="w-2 h-2 rounded-full bg-purple-500 mr-2"></span> Monthly (Recurring)
                        </h4>
                        <ul class="text-sm space-y-3">
                            <li class="flex justify-between">
                                <span class="text-gray-500">List Price:</span>
                                <span class="font-medium text-gray-900">{{ number_format($split['monthly']['list'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between pb-3 border-b border-gray-200">
                                <span class="text-gray-500">Charged:</span>
                                <span class="font-medium text-gray-900">{{ number_format($split['monthly']['charged'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between pt-1">
                                <span class="text-gray-900 font-semibold">Your Cut:</span>
                                <span class="font-bold text-emerald-600">{{ number_format($split['monthly']['partner'] / 100, 2) }} AED</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-500">House:</span>
                                <span class="font-medium text-gray-600">{{ number_format($split['monthly']['house'] / 100, 2) }} AED</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
