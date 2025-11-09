<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    // Table name (optional if it follows Laravel naming conventions)
    protected $table = 'services';

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'label',
        'slug',
        'image',
        'description',
        'button',
    ];

    /**
     * Automatically generate slug from title if not provided
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }
}
