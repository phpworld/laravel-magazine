<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Magazine::with('category');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        // Per page functionality
        $perPage = $request->get('per_page', 5);
        $magazines = $query->latest()->paginate($perPage)->appends($request->query());
        
        return view('admin.magazines.index', compact('magazines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.magazines.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'publication_date' => 'required|date',
            'week_number' => 'required|integer|min:1|max:53',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Handle checkbox values (convert to boolean)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('magazines/covers', 'public');
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('magazines/pdfs', 'public');
        }

        Magazine::create($data);

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Magazine $magazine)
    {
        $magazine->load('category');
        return view('admin.magazines.show', compact('magazine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Magazine $magazine)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.magazines.edit', compact('magazine', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'publication_date' => 'required|date',
            'week_number' => 'required|integer|min:1|max:53',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Handle checkbox values (convert to boolean)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if ($magazine->cover_image) {
                Storage::disk('public')->delete($magazine->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('magazines/covers', 'public');
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            // Delete old PDF file
            if ($magazine->pdf_file) {
                Storage::disk('public')->delete($magazine->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('magazines/pdfs', 'public');
        }

        $magazine->update($data);

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Magazine $magazine)
    {
        // Delete associated files
        if ($magazine->cover_image) {
            Storage::disk('public')->delete($magazine->cover_image);
        }
        if ($magazine->pdf_file) {
            Storage::disk('public')->delete($magazine->pdf_file);
        }

        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine deleted successfully!');
    }
}