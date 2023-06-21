<?php

namespace App\Http\Middleware;

use Closure;

class AllowLocalhost
{
    public function handle($request, Closure $next)
    {
        // Check if the request is coming from localhost
        if ($request->server('REMOTE_ADDR') === '127.0.0.1' || $request->server('REMOTE_ADDR') === '::1') {
            return $next($request);
        }

        // Return error response for non-localhost requests
        return response()->json(['message' => 'Access denied.'], 403);
    }
}
