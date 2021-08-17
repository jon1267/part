<?php

namespace App\Modules\Payment\Core\Services\Calculator;

use Illuminate\Support\Facades\DB;

class EarningCalculator
{
    private $dropinfo;

    public function __construct()
    {
        $this->dropinfo = DB::table('dropshippers')
            ->where('dropshippers.kod', auth()->user()->kod)->first();
    }

    public function getEarning()
    {
        $earnings = 0;
        $orders_info = '';

        $procent = $this->dropinfo->procent ?: 20;
        $procent_swan = $this->dropinfo->procent_swan ?: 20;
        $procent_auction = $this->dropinfo->procent_auction ?: 20;
        $procent_30ml = $this->dropinfo->procent_30ml ?: 20;

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

        return $earnings; //return ['earnings' => $earnings, 'orders_info' => $orders_info];
    }

    public function getSubEarning()
    {
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

        $sub_procent = $this->dropinfo->sub_procent ?: 2;

        $subearnings = $subearnings * $sub_procent / 100;

        return $subearnings; // return ['subearnings' => $subearnings, 'orders_info' => $orders_info];

    }

    /**
     * $data has $data['earnings'], $data['subearnings'], $data['host'] or null
     * @param array|null $data
     * @return bool
     */
    public function checkMinimum(array $data = null)
    {
        if (is_null($data)) {

            $allEarning = $this->getEarning() + $this->getSubEarning();

            return  ($this->dropinfo->host == 1) ? $allEarning >= 200 : $allEarning >= 500;
        }

        $allEarning = $data['earnings'] + $data['subearnings'];

        return ($data['host'] == 1) ? $allEarning >= 200 : $allEarning >= 500;
    }
}
