<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WasteBank;

class WasteBankController extends Controller
{
    public function index()
    {
        return response()->json(WasteBank::all());
    }
}
