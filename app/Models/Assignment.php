<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'promotion_code_id',
        'title',
        'subject',
        'deadline',
        'contact_type',
        'contact_info',
        'description',
        'price',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotionCode()
    {
        return $this->belongsTo(PromotionCode::class);
    }

    public function attachments()
    {
        return $this->hasMany(AssignmentAttachment::class);
    }
}
