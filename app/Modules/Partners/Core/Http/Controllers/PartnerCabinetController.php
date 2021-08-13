<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Console\Commands\PassivePartner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Partners\Core\Http\Requests\PartnerProfileUpdateRequest as UpdateRequest;
use App\Modules\Partners\Core\Http\Requests\PartnerCreateSiteRequest as CreateSite;
use App\Models\Dropshipper;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\Fpdf\Fpdf;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactUsNotification;
use App\Modules\Partners\Core\Http\Requests\ContactUsRequest;

//use Carbon\Carbon;
//use App\Notifications\EnjoyEarningNotification;
//use App\Notifications\PassivePartnerNotification;



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

    public function orders()
    {
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
        ]);
    }

    public function subPartners()
    {
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
        ]);
    }

    public function profit()
    {
        //заработок по субпартнерам
        $subearnings = 0;
        $orders = DB::table('landing_orders')
            ->select('landing_orders.id as id', 'landing_orders.sum as sum')
            ->leftJoin('dropshippers', 'landing_orders.kod','=', 'dropshippers.kod')
            ->where('landing_orders.sub_dropshipper_payment','=',0)
            ->whereIn('landing_orders.status', [8])
            ->where('dropshippers.kod_parent', auth()->user()->kod)
            ->groupBy('landing_orders.id') // ??? ->sum('sum')
            ->get(); //

        $subProcentObj = DB::table('dropshippers')->select('sub_procent')
            ->where('dropshippers.kod','=', auth()->user()->kod)->first(); //null,0,2 ...

        $sub_procent = $subProcentObj->sub_procent ?: 2;

        foreach ($orders as $order) {
            $subearnings += $order->sum;
        }

        $subearnings = $subearnings * $sub_procent / 100;
        //dd($sub_procent, $subearnings);

        //основной заработок
        $earnings = 0;
        $orders = DB::table('landing_orders')
            ->select('landing_orders.id as id', 'landing_orders.sum as sum', 'adv.swan', 'landing_orders.adv as adv',)
            ->leftJoin('adv', 'adv.id','=', 'landing_orders.adv')
            ->where('landing_orders.dropshipper_payment','=',0)
            ->whereIn('landing_orders.status', [8])
            ->where('landing_orders.kod', auth()->user()->kod)
            ->get(); //??? ->sum('sum')

        $dropperProcents = DB::table('dropshippers')
            ->select('kod', 'procent', 'procent_swan', 'procent_auction', 'procent_30ml')
            ->where('dropshippers.kod', auth()->user()->kod)
            ->first();
        //dd($orders, $dropperProcents);

        $procent = $dropperProcents->procent ?: 20;
        $procent_swan = $dropperProcents->procent_swan ?: 20;
        $procent_auction = $dropperProcents->procent_auction ?: 20;
        $procent_30ml = $dropperProcents->procent_30ml ?: 20;

        foreach ($orders as $order) {

            if ($order->swan == 1) {
                $earnings += ($order->sum * $procent_swan / 100);

            } elseif ($order->adv == 244) {
                $earnings += ($order->sum * $procent_auction / 100);

            } elseif ($order->adv == 246) {
                $earnings += ($order->sum * $procent_auction / 100);

            } elseif ($order->adv == 262) {
                $earnings += ($order->sum * $procent_30ml / 100);


            } else {
                $earnings += ($order->sum * $procent / 100);
            }
        }

        //dd($earnings, $subearnings);

        //таблица выплат (с пагинацией)
        $profits = DB::table('dropshipper_payments', 'payments')
            ->select('payments.id', 'payments.date', 'payments.order', 'payments.total', 'payments.active', 'payments.host',)
            ->where('payments.kod', auth()->user()->kod )
            ->orderBy('payments.id', 'desc')
            ->paginate(5);
        //dd($profits);

        $host = auth()->user()->host;
        $valuta = ($host == 1) ? ' грн.': ' руб.' ;
        $payButtonEnabled = ($host==1 && (($earnings + $subearnings) >= 200)) || ($host==2 && (($earnings + $subearnings) >= 500));


        return view('payment.profit-table', [
            'title' => 'Мой доход',
            'profits' => $profits,
            'earnings' => $earnings,
            'subearnings' => $subearnings,
            'valuta' => $valuta,
            'payButtonEnabled' => $payButtonEnabled,
        ]);

    }

    public function visitka()
    {
        header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=vizitka.pdf");

        $user = auth()->user();
        $imgTemplate = public_path('images/template.png'); //$imgTemplate = $_SERVER['DOCUMENT_ROOT'] . '/images/template.png';

        $x = 98;
        $y = 55;
        $text = strtoupper($user->domain . '.pdparis.com');
        $pdf = new Fpdf('L','mm',array($y,$x));
        //dd($pdf, $text, $imgTemplate);

        $pdf->AddPage();
        $pdf->SetTextColor(163,71,109);
        $pdf->Image($imgTemplate , 0, 0, $x, $y);

        $pdf->SetFont('Times','B',14);
        $pdf->Text(($x - $pdf->GetStringWidth($text)) / 2, 46, $text);
        $pdf->Output();

    }

    public function subPartnersOrders()
    {
        $orders = DB::table('landing_orders', 'orders')
            ->select('orders.id','orders.kod', 'orders.datebuy', 'orders.product', 'orders.sum', 'status2.name as status', 'adv.name as adv' , 'status2.id as status_id' ,
                'dropshippers.domain')
            ->leftJoin('status2', 'orders.status', '=', 'status2.id')
            ->leftJoin('adv', 'orders.adv', '=', 'adv.id')
            ->leftJoin('dropshippers', 'orders.kod','=', 'dropshippers.kod')
            ->where('dropshippers.kod_parent', auth()->user()->kod )
            ->orderBy('orders.id', 'desc')
            ->paginate(10);
        //dd($orders);

        return view('subpartners.subpartners-orders-table', [
            'title' => 'Заказы',
            'orders' => $orders,
        ]);
    }

    public function contactUs()
    {
        return view('partners.contact-us', [
            'title' => 'Написать нам',
        ]);

    }

    public function sendLetter(ContactUsRequest $request)
    {
        $data = $request->except('_token');

        Notification::route('mail', env('MAIL_FROM_ADDRESS', 'pdparis@test.com'))
            ->notify(new ContactUsNotification($data));

        return redirect()->route('cabinet')
            ->with(['status' => 'Ваше письмо отправлено.']);
    }
}
