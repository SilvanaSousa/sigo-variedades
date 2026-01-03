<?php

namespace App\Http\Middleware;

use App\Actions\TrackVisitAction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitMiddleware
{
    public function __construct(
        protected TrackVisitAction $trackVisitAction
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests for web routes (except ignored paths)
        if (!$request->isMethod('GET') || $request->ajax()) {
            return $next($request);
        }

        // 1. Anti-Bot: Check User Agent
        $userAgent = strtolower($request->header('User-Agent'));
        $botPatterns = ['bot', 'crawler', 'spider', 'scrap', 'curl', 'wget', 'slurp', 'mediapartners'];
        foreach ($botPatterns as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return $next($request); // Pass through but DO NOT track
            }
        }

        $uuid = $request->cookie('visit_uuid');
        $visit = null;
        $ipHash = hash('sha256', $request->ip());

        // 2. Anti-Bot: Limit visits per IP per day (Max 50)
        $dailyVisits = \App\Models\Visit::where('ip_hash', $ipHash)
            ->whereDate('created_at', now())
            ->count();

        if ($dailyVisits >= 50) {
            // Treat as bot/spam - pass through but DO NOT track new visit
            // Reuse existing UUID if available to maintain session continuity without bloating DB
            if ($uuid) {
                 $request->attributes->set('visit_uuid', $uuid);
            }
            return $next($request);
        }

        // 3. If cookie exists, verify if it exists in DB
        if ($uuid) {
            $visit = \App\Models\Visit::where('uuid', $uuid)->first();
        }

        // 4. If no valid visit found, create new one
        if (!$visit) {
            $uuid = $this->trackVisitAction->execute($request);
        }

        // 5. Inject UUID into request attributes for downstream use
        $request->attributes->set('visit_uuid', $uuid);

        $response = $next($request);

        // 6. Attach/Refresh cookie (30 days)
        $response->cookie('visit_uuid', $uuid, 60 * 24 * 30);

        return $response;
    }
}
