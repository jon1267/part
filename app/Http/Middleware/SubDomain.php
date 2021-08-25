<?php

namespace App\Http\Middleware;

use App\Models\Dropshipper;
use Closure;
use Illuminate\Http\Request;

class SubDomain
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $subDomain = '';
        $parseUrl  = parse_url(url()->current());

        if (isset($parseUrl['host'])) {
            if(substr_count($parseUrl['host'],'.') >= 2) {
                $subDomain = strstr($parseUrl['host'], '.', true);
            }
        }

        if (
            $subDomain === 'partner' AND
            isset($parseUrl['host']) AND
            $parseUrl['host'] != 'partner.kleopatra0707.com' AND
            $parseUrl['host'] != 'partnerru.kleopatra0707.com' AND
            $request->route()->getName() != 'welcome'
        ) {
            return redirect()->to(route('welcome'));
        }

        if ($subDomain != 'partner' AND $subDomain != 'partnerru') {
            $partner = Dropshipper::where('domain', $subDomain)
                ->where('host', config('app.host'))
                ->first();

            if ( ! $partner) {
                return redirect()->to(str_replace($subDomain . '.', '', url()->current()));
            }
        }

        return $next($request);
    }
}
