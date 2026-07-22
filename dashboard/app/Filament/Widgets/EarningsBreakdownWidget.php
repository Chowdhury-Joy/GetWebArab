<?php

namespace App\Filament\Widgets;

use App\Models\EarningLine;
use App\Models\Period;
use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class EarningsBreakdownWidget extends Widget
{
    protected string $view = 'filament.widgets.earnings-breakdown';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public string $range = 'monthly';

    protected static array $rangeLabels = [
        'monthly' => 'Monthly',
        '3month' => '3 Month',
        '6month' => '6 Month',
        '12month' => '12 Month',
        'lifetime' => 'Lifetime',
    ];

    public function setRange(string $range): void
    {
        if (array_key_exists($range, static::$rangeLabels)) {
            $this->range = $range;
        }
    }

    public function getRangeLabels(): array
    {
        return static::$rangeLabels;
    }

    protected function periodIds(): Collection
    {
        $query = Period::where('state', 'closed')
            ->orderByDesc('year')
            ->orderByDesc('month');

        $limit = match ($this->range) {
            'monthly' => 1,
            '3month' => 3,
            '6month' => 6,
            '12month' => 12,
            default => null,
        };

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->pluck('id');
    }

    public function getHouseTotal(): int
    {
        return EarningLine::whereIn('period_id', $this->periodIds())->sum('house_fils');
    }

    public function getPartnerBreakdown(): Collection
    {
        $periodIds = $this->periodIds();

        return EarningLine::whereIn('period_id', $periodIds)
            ->selectRaw('partner_id, SUM(partner_fils) as total_earned')
            ->groupBy('partner_id')
            ->orderByDesc('total_earned')
            ->get()
            ->map(function ($row) {
                $partner = User::find($row->partner_id);

                return (object) [
                    'name' => $partner?->name ?? 'Unknown Partner',
                    'total_earned' => (int) $row->total_earned,
                ];
            });
    }

    public function hasAnyClosedPeriods(): bool
    {
        return Period::where('state', 'closed')->exists();
    }
}
