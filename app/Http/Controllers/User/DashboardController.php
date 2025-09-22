<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        // Get user statistics
        $purchases = $user->purchases()->with(['magazine.category'])->latest()->paginate(10);
        $purchaseCount = $user->purchases()->count();
        $totalSpent = $user->purchases()->sum('amount');
        $totalDownloads = $user->purchases()->sum('download_count');
        
        // Get recent purchases for overview
        $recentPurchases = $user->purchases()
            ->with(['magazine.category'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('user.dashboard', compact(
            'purchases',
            'purchaseCount',
            'totalSpent',
            'totalDownloads',
            'recentPurchases'
        ));
    }
}