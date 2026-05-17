<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiKey;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function generate(Request $request)
    {
        $user = auth()->user();
        
        $key = Str::random(40);
        
        $apiKey = ApiKey::create([
            'user_id' => $user->id,
            'api_key' => hash('sha256', $key),
            'status' => 'active'
        ]);

        return response()->json([
            'message' => 'API Key generated successfully. Please copy it now as you will not be able to see it again.',
            'api_key' => $key,
            'record' => $apiKey
        ]);
    }
}
