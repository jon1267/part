<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Modules\Partners\Core\Http\Requests\PartnerLoginRequest;
use App\Models\Dropshipper;

class PartnerLoginController extends Controller
{
    public function index()
    {
        return view('partners.index');
    }

    public function enter()
    {
        return view('partners.login');
    }

    public function resetPassword()
    {
        return view('partners.reset-password');
    }

    public function login(PartnerLoginRequest $request)
    {
        $email = $request->email;
        $password = md5($request->password, false);

        $partner = Dropshipper::where('email', $email)->where('pass', $password)->first();
        $envHost = env('APP_HOST');// "1"
        $configHost = config('app.host'); //"1"

        if (is_null($partner)) {
            return redirect()->route('enter')->with(['error' => 'Такой партнер не найден...']);
        }

        $correctHost = ($partner->host === (int) $envHost) || ($partner->host === (int) $configHost);

//        if (!$correctHost) {
//            return redirect()->route('enter')
//                ->with(['error' => 'Неверный хост. Попытка зайти на Русский ресурс с данными для Украины или наоборот.']);
//        }

        // infrm@ya.ru ,  12345
        //dd($partner, $partner->host, $envHost, $configHost);
        return redirect()->route('cabinet', ['partner' => $partner]);

    }
}
