<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'gallery',
        'price',
        'whatsapp_number',
        'is_featured',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];
}
