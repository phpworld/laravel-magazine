<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Magazine;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Generate slugs for magazines that don't have them
        $magazines = Magazine::whereNull('slug')->orWhere('slug', '')->get();
        
        foreach ($magazines as $magazine) {
            $baseSlug = Str::slug($magazine->title);
            $slug = $baseSlug;
            $counter = 1;
            
            // Ensure slug is unique
            while (Magazine::where('slug', $slug)->where('id', '!=', $magazine->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $magazine->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set all slugs to null
        Magazine::query()->update(['slug' => null]);
    }
};
