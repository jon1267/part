<?php

namespace App\Modules\Payment\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestPaymentDropshipperNotification;

class PartnerPaymentController extends controller
{
    public function requestPayment()
    {
        $dropinfo = DB::table('dropshippers')
            ->where('dropshippers.kod', auth()->user()->kod)->first();

        $earnings = 0;
        $orders_info = '';

        $procent = $dropinfo->procent ?: 20;
        $procent_swan = $dropinfo->procent_swan ?: 20;
        $procent_auction = $dropinfo->procent_auction ?: 20;
        $procent_30ml = $dropinfo->procent_30ml ?: 20;

        $orders = DB::table('landing_orders')
            ->select('landing_orders.*', 'adv.swan')
            ->leftJoin('adv', 'adv.id', '=', 'landing_orders.adv')
            ->where('dropshipper_payment', '=',0)
            ->whereIn('landing_orders.status', [8])
            ->where('kod', '=', auth()->user()->kod)
            ->get();

        foreach($orders as $order) {

            if ($order->swan == 1) {
                $earnings += ($order->sum * $procent_swan / 100);
                $orders_info .= 'Заказ №' . $order->id . ' (Украшения)<br/>';

            } elseif ($order->adv == 244) {
                $earnings += ($order->sum * $procent_auction / 100);
                $orders_info .= 'Заказ №' . $order->id . ' (Аукцион)<br/>';

            } elseif ($order->adv == 262) {
                $earnings += ($order->sum * $procent_30ml / 100);
                $orders_info .= 'Заказ №' . $order->id . ' (Магазин 30ml)<br/>';


            } else {
                $earnings += ($order->sum * $procent / 100);
                $orders_info .= 'Заказ №' . $order->id . ' (Парфюмерия)<br/>';
            }
        }

        $subearnings = 0;
        $suborders = DB::table('landing_orders')
            ->leftJoin('dropshippers', 'landing_orders.kod', '=' ,'dropshippers.kod')
            ->select('landing_orders.id as id', 'landing_orders.sum as sum')
            ->where('landing_orders.sub_dropshipper_payment', '=',0)
            ->whereIn('landing_orders.status', [8])
            ->where('dropshippers.kod_parent','=', auth()->user()->kod)
            ->groupBy('landing_orders.id')
            ->get(); // вместо ->groupBy() и get() и foreach() просто  ->sum('sum') ???

        foreach ($suborders as $suborder) {
            $subearnings += $suborder->sum;
            $orders_info .= 'Заказ Субпартнера №' . $suborder->id . '<br/>';
        }

        $sub_procent = $dropinfo->sub_procent ?: 2;

        $subearnings = $subearnings * $sub_procent / 100;

        //$dropshipper ? оно в $dropinfo

        $host = $dropinfo->host;
        $valuta = ($host == 1) ? ' грн.': ' руб.';
        $min = ($host == 1) ? 200 : 500;
        //dd($earnings, $subearnings, $dropinfo);

        if ($earnings + $subearnings >= $min) {
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
                'order' => $orders_info,
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
            Notification::route('mail', 'partner.pdparis@gmail.com')
                ->notify(new RequestPaymentDropshipperNotification($payment));

            return redirect()->route('cabinet')
                ->with(['status' => 'Запрошенный платеж отправлен']);

        }

    }
}
