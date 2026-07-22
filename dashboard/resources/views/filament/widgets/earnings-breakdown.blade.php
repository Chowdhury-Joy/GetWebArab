<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Earnings Breakdown
        </x-slot>
        <x-slot name="description">
            Based on settled (closed) months only — the current open month is a live estimate shown separately above.
        </x-slot>

        <x-slot name="afterHeader">
            <div class="flex flex-wrap gap-1">
                @foreach ($this->getRangeLabels() as $value => $label)
                    <button
                        type="button"
                        wire:click="setRange('{{ $value }}')"
                        @class([
                            'px-3 py-1 rounded-md text-xs font-medium transition-colors',
                            'bg-primary-600 text-white' => $range === $value,
                            'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700' => $range !== $value,
                        ])
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </x-slot>

        @if (! $this->hasAnyClosedPeriods())
            <p class="text-sm text-gray-500 dark:text-gray-400">
                No settled months yet — close a billing period to see earnings here.
            </p>
        @else
            <div class="mb-6 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-900 p-4">
                <div class="text-xs font-semibold uppercase tracking-wide text-emerald-700 dark:text-emerald-400">
                    Your Earnings (House)
                </div>
                <div class="text-3xl font-bold text-emerald-800 dark:text-emerald-300 mt-1">
                    {{ number_format($this->getHouseTotal() / 100, 2) }} <span class="text-base font-medium">AED</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="py-2 pr-4 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Partner</th>
                            <th class="py-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400 text-right">Earned</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($this->getPartnerBreakdown() as $row)
                            <tr>
                                <td class="py-2 pr-4 text-sm text-gray-900 dark:text-gray-100">{{ $row->name }}</td>
                                <td class="py-2 text-sm text-gray-900 dark:text-gray-100 text-right font-medium">
                                    {{ number_format($row->total_earned / 100, 2) }} AED
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                    No partner earnings in this range.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
