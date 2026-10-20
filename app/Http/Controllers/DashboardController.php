<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Loan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->role === 'admin';
        $loanQuery = Loan::query();
        if (!$isAdmin) $loanQuery->where('user_id', auth()->id());
        $stats = [
            'equipment' => Equipment::count(),
            'available' => Equipment::sum('stock'),
            'loans' => (clone $loanQuery)->whereIn('status', ['disetujui'])->count(),
            'pending' => (clone $loanQuery)->where('status', 'menunggu')->count(),
        ];
        $recentLoans = $loanQuery->with(['user', 'items.equipment'])->latest()->take(6)->get();
        $userCount = $isAdmin ? User::count() : 0;

        return view('dashboard', compact('stats', 'recentLoans', 'userCount'));
    }
}
