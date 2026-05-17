<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'address',
        'latitude',
        'longitude',
        'operational_hour',
    ];
}
