<?php

namespace App\Modules\Payment\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use App\Modules\Payment\Core\Http\Requests\SavePaymentRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestPaymentDropshipperNotification;
use App\Modules\Payment\Core\Services\Calculator\EarningCalculator;

class PartnerPaymentController extends controller
{

    public function requestPayment(SavePaymentRequest $request)
    {
        $calculator = app(EarningCalculator::class);
        $data = $request->except('_token');
        //dd($data);
        if (!$calculator->checkMinimum($data)) {
            return redirect()->route('cabinet')
                ->with(['error' => 'Не соблюдается необходимый минимум для платформы.']);
        }

        $earnings = $calculator->getEarning();
        $subearnings = $calculator->getSubEarning();

        $dropinfo = DB::table('dropshippers')
            ->where('dropshippers.kod', auth()->user()->kod)->first();

        $host = $dropinfo->host;
        $valuta = ($host == 1) ? ' грн.': ' руб.';
        //$min = ($host == 1) ? 200 : 500;
        //dd($earnings, $subearnings, $dropinfo);

        if ($calculator->checkMinimum()) {
            // Добавляем платеж
            $payment = [
                'host'  => $dropinfo->host,
                'email' => $dropinfo->email,
                'kod'   => $dropinfo->kod,
                'tel'   => $dropinfo->tel,
                'name'  => $dropinfo->name,
                'bank'  => $dropinfo->bank,
                'text'  => $dropinfo->text,
                'date'  => date('Y-m-d H:i:s'),
                'order' => '',//$orders_info, //?
                'total' => $earnings + $subearnings,
                'active'=> 0,
            ];
            DB::table('dropshipper_payments')->insert($payment);

            // Обнуляем заказы партнера
            DB::table('landing_orders')
                ->where('dropshipper_payment', '=', 0)
                ->whereIn('status',[8])
                ->where('kod', '=',  auth()->user()->kod)
                ->update(['dropshipper_payment' => 1]);

            // обнуляем заказы субпартнера
            $suborders = DB::table('landing_orders')
                ->leftJoin('dropshippers', 'landing_orders.kod', '=' ,'dropshippers.kod')
                ->select('landing_orders.id as id', 'landing_orders.sum as sum')
                ->where('landing_orders.sub_dropshipper_payment', '=',0)
                ->whereIn('landing_orders.status', [8])
                ->where('dropshippers.kod_parent','=', auth()->user()->kod)
                ->groupBy('landing_orders.id')
                ->get(); // вместо ->groupBy() и get() и foreach() просто  ->sum('sum') ???

            foreach ($suborders as $order) {
                DB::table('landing_orders')
                    ->where('id', '=', $order->id)
                    ->update(['sub_dropshipper_payment' => 1]);
            }

            // обнуляем колонку заработка партнера
            DB::table('dropshippers')
                ->where('kod','=', auth()->user()->kod)
                ->update(['earning' => 0, 'orders_total' => 0]);

            // отправляем письмо поставщику (тут Notification-> просто на строку email, без mailable объекта $user)

            $payment['valuta'] = $valuta;
            Notification::route('mail', 'partner.pdparis@gmail.com')
                ->notify(new RequestPaymentDropshipperNotification($payment));

            return redirect()->route('cabinet')
                ->with(['status' => 'Запрошенный платеж отправлен']);

        }

        return redirect()->route('cabinet')
            ->with(['error' => 'Запрошенный платеж не был отправлен.']);

    }
}
