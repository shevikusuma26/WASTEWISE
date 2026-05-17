<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');

        if (!$apiKey) {
            return response()->json(['message' => 'API Key is missing'], 401);
        }

        $keyRecord = ApiKey::where('api_key', $apiKey)->where('status', 'active')->first();

        if (!$keyRecord) {
            return response()->json(['message' => 'Invalid or inactive API Key'], 401);
        }

        return $next($request);
    }
}
