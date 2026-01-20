<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'price',
        'is_featured',
        'gallery',
        'rating',
        'destination',
        'departure_place',
        'departure_date',
        'return_date',
        'gallery_text',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'departure_date' => 'date',
        'return_date' => 'date',
        'rating' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
