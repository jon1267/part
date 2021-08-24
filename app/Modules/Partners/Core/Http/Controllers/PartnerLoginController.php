<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $email    = $request->email;
        $password = md5($request->password, false);

        $partner = Dropshipper::where('email', $email)
            ->where('pass', $password)
            ->where('host', config('app.host'))
            ->first();

        if (is_null($partner)) {
            return redirect()->route('enter')->with(['error' => 'Партнер не найден.']);
        }

        return redirect()->route('cabinet', ['partner' => $partner]);
    }
}
