<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code',
        'discount_percentage',
        'expiry_date',
        'status',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'promotion_code_user');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($promotionCode) {
            if (empty($promotionCode->promo_code)) {
                $promotionCode->promo_code = static::generateUniquePromoCode();
            }
        });
    }

    private static function generateUniquePromoCode()
    {
        do {
            $code = 'USPC' . rand(10000, 99999);
        } while (static::where('promo_code', $code)->exists());

        return $code;
    }
}
