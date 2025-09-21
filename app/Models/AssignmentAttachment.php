<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignmentAttachment extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'assignment_id',
        'file_path',
        'media_type',
    ];

    // Relation to Assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
