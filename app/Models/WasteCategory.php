<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
    ];

    public function scans()
    {
        return $this->hasMany(WasteScan::class, 'category_id');
    }
}
