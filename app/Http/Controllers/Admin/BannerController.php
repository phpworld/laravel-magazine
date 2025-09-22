<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::ordered()->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:on',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Debug: Check if file is uploaded
        if (!$request->hasFile('image')) {
            return redirect()->back()->withErrors(['image' => 'No image file was uploaded.'])->withInput();
        }

        // Debug: Check if file is valid
        $uploadedFile = $request->file('image');
        if (!$uploadedFile->isValid()) {
            return redirect()->back()->withErrors(['image' => 'The uploaded file is not valid.'])->withInput();
        }

        // Handle image upload with error handling
        try {
            $imagePath = $uploadedFile->store('banners', 'public');
            
            if (!$imagePath) {
                return redirect()->back()->withErrors(['image' => 'Failed to store the uploaded image.'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['image' => 'Upload failed: ' . $e->getMessage()])->withInput();
        }

        // Get the next sort order if not provided
        $sortOrder = $request->sort_order ?? (Banner::max('sort_order') + 1);

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'image_path' => $imagePath,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $sortOrder,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        // Debug: Log the request data
        \Log::info('Banner update request data:', $request->all());
        \Log::info('Banner update files:', $request->allFiles());
        \Log::info('Request method: ' . $request->method());
        \Log::info('Request has file image: ' . ($request->hasFile('image') ? 'YES' : 'NO'));

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:on',
        ]);

        if ($validator->fails()) {
            \Log::error('Banner update validation failed:', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? $banner->sort_order,
            'is_active' => $request->has('is_active'),
        ];

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            \Log::info('Image file uploaded for banner update');
            
            // Debug: Check if file is valid
            $uploadedFile = $request->file('image');
            \Log::info('Uploaded file details:', [
                'name' => $uploadedFile->getClientOriginalName(),
                'size' => $uploadedFile->getSize(),
                'mime' => $uploadedFile->getMimeType(),
                'extension' => $uploadedFile->getClientOriginalExtension(),
                'isValid' => $uploadedFile->isValid()
            ]);
            
            if (!$uploadedFile->isValid()) {
                \Log::error('Uploaded file is not valid');
                return redirect()->back()->withErrors(['image' => 'The uploaded file is not valid.'])->withInput();
            }

            try {
                // Delete old image if it exists
                if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                    Storage::disk('public')->delete($banner->image_path);
                    \Log::info('Deleted old image: ' . $banner->image_path);
                }

                $newImagePath = $uploadedFile->store('banners', 'public');
                
                if (!$newImagePath) {
                    \Log::error('Failed to store uploaded image');
                    return redirect()->back()->withErrors(['image' => 'Failed to store the uploaded image.'])->withInput();
                }
                
                \Log::info('New image stored at: ' . $newImagePath);
                $data['image_path'] = $newImagePath;
            } catch (\Exception $e) {
                \Log::error('Exception during image upload: ' . $e->getMessage());
                return redirect()->back()->withErrors(['image' => 'Upload failed: ' . $e->getMessage()])->withInput();
            }
        } else {
            \Log::info('No image file uploaded');
            // If no new image is uploaded but the old image is missing, require an image
            if ($banner->image_path && !Storage::disk('public')->exists($banner->image_path)) {
                \Log::warning('Original image is missing: ' . $banner->image_path);
                return redirect()->back()->withErrors(['image' => 'The original image is missing. Please upload a new image.'])->withInput();
            }
        }

        $banner->update($data);
        \Log::info('Banner updated successfully: ' . $banner->id);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete image file
        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }

    /**
     * Update banner order.
     */
    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banners' => 'required|array',
            'banners.*.id' => 'required|exists:banners,id',
            'banners.*.sort_order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data provided.']);
        }

        foreach ($request->banners as $bannerData) {
            Banner::where('id', $bannerData['id'])->update(['sort_order' => $bannerData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Banner order updated successfully!']);
    }

    /**
     * Toggle banner status.
     */
    public function toggleStatus(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);

        $status = $banner->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.banners.index')->with('success', "Banner {$status} successfully!");
    }
}
