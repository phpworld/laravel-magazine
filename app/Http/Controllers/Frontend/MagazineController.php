<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Category;
use App\Models\Option;
use App\Models\Banner;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)->withCount('magazines')->get();
        
        $query = Magazine::with('category')
            ->where('is_active', true)
            ->latest('publication_date');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $magazines = $query->paginate(12);
        $featuredMagazines = Magazine::where('is_active', true)
            ->where('is_featured', true)
            ->latest('publication_date')
            ->take(12)
            ->get();

        return view('frontend.magazines.index', compact('magazines', 'categories', 'featuredMagazines'));
    }

    public function show(Magazine $magazine)
    {
        if (!$magazine->is_active) {
            abort(404);
        }

        $relatedMagazines = Magazine::where('category_id', $magazine->category_id)
            ->where('id', '!=', $magazine->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        $userHasPurchased = false;
        if (auth()->check()) {
            $userHasPurchased = auth()->user()->hasPurchased($magazine);
        }

        return view('frontend.magazines.show', compact('magazine', 'relatedMagazines', 'userHasPurchased'));
    }

    public function home()
    {
        $featuredMagazines = Magazine::where('is_active', true)
            ->where('is_featured', true)
            ->latest('publication_date')
            ->take(8)
            ->get();
            
        $categories = Category::where('is_active', true)
            ->withCount(['magazines' => function($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        $latestMagazines = Magazine::where('is_active', true)
            ->latest('publication_date')
            ->take(6)
            ->get();
            
        // Get active banners for slider
        $banners = Banner::active()->ordered()->get();
        
        // Get logo from options
        $logo = Option::where('key', 'logo')->first()?->value;

        return view('frontend.home', compact('featuredMagazines', 'categories', 'latestMagazines', 'banners', 'logo'));
    }
}
