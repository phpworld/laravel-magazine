<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of all purchases.
     */
    public function index(Request $request)
    {
        $query = Purchase::with(['user', 'magazine']);

        // Filter by payment status
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by user name or magazine title
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhereHas('magazine', function($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                });
            });
        }

        $purchases = $query->latest()->paginate(20);

        $stats = [
            'total_purchases' => Purchase::count(),
            'completed_purchases' => Purchase::where('payment_status', 'completed')->count(),
            'pending_purchases' => Purchase::where('payment_status', 'pending')->count(),
            'failed_purchases' => Purchase::where('payment_status', 'failed')->count(),
            'total_revenue' => Purchase::where('payment_status', 'completed')->sum('amount'),
        ];

        return view('admin.purchases.index', compact('purchases', 'stats'));
    }

    /**
     * Display the specified purchase.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load(['user', 'magazine']);
        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Update the payment status of a purchase.
     */
    public function updateStatus(Request $request, Purchase $purchase)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded'
        ]);

        $purchase->update([
            'payment_status' => $request->payment_status
        ]);

        return redirect()->back()->with('success', 'Purchase status updated successfully!');
    }

    /**
     * Delete a purchase record.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('admin.purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}