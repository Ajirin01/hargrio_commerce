<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'price',
        'variations',
        'image',
        'short_description',
        'long_description',
        'preparation_instructions',
        'preparation_link',
        'available'
    ];

    protected $casts = [
        'variations' => 'array',
        'available' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
