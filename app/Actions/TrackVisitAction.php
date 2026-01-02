<?php

namespace App\Actions;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrackVisitAction
{
    public function execute(Request $request): string
    {
        $uuid = (string) Str::uuid();

        Visit::create([
            'uuid' => $uuid,
            'ip_hash' => hash('sha256', $request->ip()),
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer'),
            'utm_source' => $request->query('utm_source'),
            'utm_medium' => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
        ]);

        return $uuid;
    }
}
