<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'button',
        'short_description',
        'description',
    ];

    // Automatically generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($treatment) {
            $treatment->slug = Str::slug($treatment->title);
        });
    }
}
