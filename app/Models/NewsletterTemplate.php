<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'message',
        'variables',
    ];

    protected $casts = [
        'variables' => 'array', // automatically casts JSON to array
    ];
}
