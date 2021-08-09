<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Console\Commands\PassivePartner;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Modules\Partners\Core\Http\Requests\PartnerProfileUpdateRequest as UpdateRequest;
use App\Modules\Partners\Core\Http\Requests\PartnerCreateSiteRequest as CreateSite;
use App\Models\Dropshipper;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
//use App\Notifications\PartnerRegisterdNotivication;
use App\Notifications\PassivePartnerNotification;
use Illuminate\Support\Facades\Notification;

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
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[0] = 'active';

        return view('partners.profile', [
            'title' => 'Ваш профиль',
            'user' => auth()->user(),
            'active' => $active,
        ]);
    }

    public function updateProfile(UpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('_token', '_method' ,'password_confirmation');
        $data['notification'] = (isset($data['notification']) && $data['notification'] == 'on') ? 1 : 0;
        for($i = 0; $i<10; $i++)  $active[$i] = null;

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
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[1] = 'active';

        return view('partners.how-to-earn', [
            'title' => 'Как начать зарабатывать',
            'active' => $active,
        ]);
    }

    public function material()
    {
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[2] = 'active';

        return view('partners.material', [
            'title' => 'Рекламные материалы',
            'active' => $active,
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

    public function orders()
    {
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[3] = 'active';

        $orders = DB::table('landing_orders', 'orders')
            ->select('orders.id','orders.kod', 'orders.datebuy', 'orders.product', 'orders.sum', 'status2.name as status', 'adv.name as adv' , 'status2.id as status_id' , )
            ->leftJoin('status2', 'orders.status', '=', 'status2.id')
            ->leftJoin('adv', 'orders.adv', '=', 'adv.id')
            ->where('orders.kod', auth()->user()->kod )
            ->orderBy('id', 'desc')
            ->paginate(10);
        //dd($orders);

        return view('partners.orders-table', [
            'title' => 'Заказы',
            'orders' => $orders,
            'active' => $active,
        ]);
    }

    public function subPartners()
    {
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[4] = 'active';

        $subpartners = DB::table('dropshippers', 'dr')
            ->select('dr.id','dr.name', 'dr.tel', 'dr.domain', 'dr.created',
                DB::raw('COUNT(landing_orders.id) as total_orders'))
            ->leftJoin('landing_orders', 'dr.kod','=','landing_orders.kod')
            ->where('dr.kod_parent', auth()->user()->kod )
            ->orderBy('dr.id', 'desc')
            ->groupBy('dr.id')
            ->paginate(10);
        //dd($subpartners);

        return view('partners.subpartners-table', [
            'title' => 'Заказы субпартнеров',
            'subpartners' => $subpartners,
            'active' => $active,
        ]);
    }

    public function profit()
    {
        for($i = 0; $i<10; $i++)  $active[$i] = null;
        $active[5] = 'active';

        $profits = DB::table('dropshipper_payments', 'payments')
            ->select('payments.id', 'payments.date', 'payments.order', 'payments.total', 'payments.active', 'payments.host',)
            ->where('payments.kod', auth()->user()->kod )
            ->orderBy('payments.id', 'desc')
            ->paginate(5);
        //dd($profits);

        return view('payment.profit-table', [
            'title' => 'Мой доход',
            'profits' => $profits,
            'active' => $active,
        ]);


    }

    //$user = auth()->user();
    //$user->notify(new PartnerRegisterdNotivication());

    //для тестов (после тестир регистрации партнера убрать)
    public function notify()
    {
        $partners = Dropshipper::where('domain','')
            ->whereDate('created', '<', Carbon::now()->subDays(3)->toDateTimeString())
            ->get();
        dd($partners, count($partners));

        Notification::send($partners, new PassivePartnerNotification());

    }
}
