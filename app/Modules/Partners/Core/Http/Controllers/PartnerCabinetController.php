<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Modules\Partners\Core\Http\Requests\PartnerProfileUpdateRequest as UpdateRequest;
use App\Modules\Partners\Core\Http\Requests\PartnerCreateSiteRequest as CreateSite;
use App\Models\Dropshipper;
use function PHPUnit\Framework\isEmpty;

//use App\Notifications\PartnerRegisterdNotivication;

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

    public function material()
    {
        return view('partners.material', [
            'title' => 'Рекламные материалы',
        ]);
    }

    public function createSite(CreateSite $request)
    {
        $data = $request->except('_token');
        $user = auth()->user();
        //dd($data, $user->host);
        $hasSameNameHost = Dropshipper::where('host', $user->host)
            ->where('domain', $request->domain)
            ->first();

        if (!$hasSameNameHost) {
            $user->update($data);
            return redirect()->route('cabinet')
                ->with(['status' => 'Ваш сайт успешно создан.']);
        }

        return redirect()->route('cabinet')
            ->with(['error' => 'Ошибка создания сайта. Такой домен на платформе кажется уже есть.']);
    }

    //для тестов (после тестир регистрации партнера убрать)
    /*public function notify()
    {
        $user = auth()->user();
        $user->notify(new PartnerRegisterdNotivication());

    }*/
}
