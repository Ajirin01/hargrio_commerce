<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedPromo extends Model
{
    protected $fillable = [
        'user_id',
        'promo_code_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promo()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
}