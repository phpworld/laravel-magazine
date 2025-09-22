<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Get an option value by key.
     */
    public static function getValue($key, $default = null)
    {
        return Cache::remember("option_{$key}", 3600, function () use ($key, $default) {
            $option = self::where('key', $key)->first();
            return $option ? $option->value : $default;
        });
    }

    /**
     * Set an option value by key.
     */
    public static function setValue($key, $value, $description = null)
    {
        $option = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description,
            ]
        );

        // Clear cache for this option
        Cache::forget("option_{$key}");

        return $option;
    }

    /**
     * Get all options as key-value pairs.
     */
    public static function getAllOptions()
    {
        return self::pluck('value', 'key')->toArray();
    }

    /**
     * Remove an option by key.
     */
    public static function removeOption($key)
    {
        Cache::forget("option_{$key}");
        return self::where('key', $key)->delete();
    }

    /**
     * Check if an option exists.
     */
    public static function hasOption($key)
    {
        return self::where('key', $key)->exists();
    }

    /**
     * Get multiple options by keys.
     */
    public static function getMultiple($keys, $defaults = [])
    {
        $options = [];
        foreach ($keys as $key) {
            $default = isset($defaults[$key]) ? $defaults[$key] : null;
            $options[$key] = self::getValue($key, $default);
        }
        return $options;
    }

    /**
     * Set multiple options at once.
     */
    public static function setMultiple($options)
    {
        foreach ($options as $key => $value) {
            self::setValue($key, $value);
        }
    }
}