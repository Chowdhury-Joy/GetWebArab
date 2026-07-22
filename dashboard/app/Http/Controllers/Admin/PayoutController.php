<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\User;
use App\Models\Payout;
use App\Models\EarningLine;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Period $period)
    {
        if ($period->state !== 'closed') {
            return redirect()->route('admin.periods.index')->with('error', 'Cannot view payouts for an open period.');
        }

        // Get all partners who have earning lines in this period
        $partnerIds = EarningLine::where('period_id', $period->id)
            ->pluck('partner_id')
            ->unique();
        
        $partners = User::whereIn('id', $partnerIds)->get();

        $payoutsData = [];
        foreach ($partners as $partner) {
            $earned = $partner->earnedForPeriod($period);
            $payout = Payout::where('partner_id', $partner->id)->where('period_id', $period->id)->first();
            
            $payoutsData[] = (object)[
                'partner' => $partner,
                'earned' => $earned,
                'is_paid' => $payout !== null,
                'payout' => $payout
            ];
        }

        return view('admin.payouts.index', compact('period', 'payoutsData'));
    }

    public function store(Request $request, Period $period, User $partner)
    {
        abort_unless($partner->isPartner(), 403, 'User is not a partner.');

        if ($period->state !== 'closed') {
            return back()->with('error', 'Cannot record payout for an open period.');
        }

        $data = $request->validate([
            'amount_fils' => 'required|numeric|min:0',
            'paid_at' => 'required|date',
            'method' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        if (Payout::where('partner_id', $partner->id)->where('period_id', $period->id)->exists()) {
            return back()->with('error', 'Payout already recorded for this partner and period.');
        }

        $earned = $partner->earnedForPeriod($period);
        if ($data['amount_fils'] != $earned) {
            return back()->with('error', 'The payout amount must exactly match the earned amount for this period.');
        }

        Payout::create([
            'partner_id' => $partner->id,
            'period_id' => $period->id,
            'amount_fils' => $data['amount_fils'],
            'paid_at' => $data['paid_at'],
            'method' => $data['method'],
            'reference' => $data['reference'],
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Payout recorded successfully.');
    }
}
