<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_magazines' => Magazine::count(),
            'total_categories' => Category::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_sales' => Purchase::where('payment_status', 'completed')->sum('amount'),
            'weekly_sales' => Purchase::where('payment_status', 'completed')
                ->whereDate('created_at', '>=', now()->startOfWeek())
                ->sum('amount'),
        ];

        $recent_purchases = Purchase::with(['user', 'magazine'])
            ->where('payment_status', 'completed')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_purchases'));
    }
}
