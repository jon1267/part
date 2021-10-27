<?php

namespace App\Http\Middleware;

use App\Models\Dropshipper;
use Closure;
use Illuminate\Http\Request;

class LanguageUa
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale('ua');
        return $next($request);
    }
}
