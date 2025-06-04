<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\MaintenanceSetting;
use Carbon\Carbon;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        $today_date = Carbon::now()->format('Y-m-d');
        $today_time = Carbon::now()->format('H:i');

        $setting = MaintenanceSetting::where('date', $today_date)->where('from_time', '<=', $today_time)->where('to_time', '>=', $today_time)->first();
        if(!empty($setting)){
            return redirect()->route('under.maintenance')->with('setting', $setting);           
        }
        return $next($request);
    }
}