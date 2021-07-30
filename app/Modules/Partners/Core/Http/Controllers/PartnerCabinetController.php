<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Modules\Partners\Core\Http\Requests\PartnerProfileUpdateRequest as UpdateRequest;
use App\Models\Dropshipper;
use App\Notifications\PartnerRegisterdNotivication;

class PartnerCabinetController extends Controller
{
    public function index()
    {
        return view('partners.index');
    }

    public function cabinet()
    {
        return view('adminlte.admin');
        //return view('partners.cabinet');
    }

    public function profile()
    {
        return view('partners.profile', [
            'title' => 'Ваш профиль',
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(UpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('_token', '_method' ,'password_confirmation');
        $data['notification'] = (isset($data['notification']) && $data['notification'] == 'on') ? 1 : 0;

        // ввели пароль - меняем, не ввели - оставляем старый
        if(isset($data['password'])) {
            $data['pass'] = md5($data['password'],false);
        } else {
            $data['pass'] = $user->pass;
        }

        //dd($data, $user);

        if($user->update($data)) {
            return redirect()->route('cabinet')
                ->with(['status' => 'Данные профиля обновлены']);
        }

        return redirect()->route('cabinet')
            ->with(['error' => 'Ошибка обновления профиля.']);
    }

    public function howToEarn()
    {

        return view('partners.how-to-earn', [
            'title' => 'Как начать зарабатывать',
        ]);
    }

    public function notify()
    {
        $user = auth()->user();
        $user->notify(new PartnerRegisterdNotivication());

    }
}
