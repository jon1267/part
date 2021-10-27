<?php

namespace App\Modules\Front\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{
    /**
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($lang)
    {
        app()->setLocale($lang);

        $route = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

        if (strpos($route, 'ua.') !== false AND $lang === 'ru') {
            $route = str_replace('ua.', '', $route);
        }

        if (strpos($route, 'ua.') === false AND $lang === 'ua') {
            $route = 'ua.' . $route;
        }

        return redirect()->to(route($route));
    }
}
