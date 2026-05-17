<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteScan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'image',
        'confidence_score',
        'scan_result',
        'recommendation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(WasteCategory::class, 'category_id');
    }
}
