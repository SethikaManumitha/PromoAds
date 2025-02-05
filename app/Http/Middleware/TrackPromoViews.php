<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class TrackPromoViews
{
    public function handle($request, Closure $next)
    {
        $businessId = $request->route('userId');
        $visitorId = Cookie::get('visitor_id', Str::random(32));
        Cookie::queue('visitor_id', $visitorId, 60 * 24 * 365);

        $existingVisit = DB::table('promo_views')
            ->where('business_id', $businessId)
            ->where('visitor_id', $visitorId)
            ->exists();

        if (!$existingVisit) {
            DB::table('promo_views')->insert([
                'business_id' => $businessId,
                'visitor_id' => $visitorId,
                'views' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('promo_views')
            ->where('business_id', $businessId)
            ->update(['views' => DB::raw('views + 1'), 'updated_at' => now()]);

        return $next($request);
    }
}
