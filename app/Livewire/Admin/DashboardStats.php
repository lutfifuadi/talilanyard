<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Accessory;
use App\Models\OrderLog;
use Carbon\Carbon;

class DashboardStats extends Component
{
    public function render()
    {
        $totalProducts = Product::count();
        $totalAccessories = Accessory::count();
        
        $todayClicks = OrderLog::whereDate('created_at', Carbon::today())->count();
        $monthClicks = OrderLog::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $recentLogs = OrderLog::with(['product', 'accessories'])
            ->latest()
            ->limit(10)
            ->get();

        return view('livewire.admin.dashboard-stats', [
            'totalProducts' => $totalProducts,
            'totalAccessories' => $totalAccessories,
            'todayClicks' => $todayClicks,
            'monthClicks' => $monthClicks,
            'recentLogs' => $recentLogs,
        ])->layout('layouts.layoutMaster');
    }
}
