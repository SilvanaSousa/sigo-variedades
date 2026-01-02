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
        // Only track GET requests for web routes
        if (!$request->isMethod('GET') || $request->ajax()) {
            return $next($request);
        }

        // Check if cookie exists
        if (!$request->hasCookie('visit_uuid')) {
            // Create new visit and get UUID
            $uuid = $this->trackVisitAction->execute($request);

            $response = $next($request);

            // Set cookie for 30 days
            $response->cookie('visit_uuid', $uuid, 60 * 24 * 30);

            return $response;
        }

        // Cookie exists, no new visit needed
        return $next($request);
    }
}
