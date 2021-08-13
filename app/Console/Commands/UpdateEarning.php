<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Dropshipper;

class UpdateEarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:earning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate earning, total & update one in dropshippers table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dropshippers = [];
        $orders = DB::table('landing_orders')
            ->select('landing_orders.sum as sum', 'landing_orders.adv as adv_id', 'adv.swan',
                'dropshippers.email', 'dropshippers.host', 'dropshippers.kod', 'dropshippers.domain',
                'dropshippers.procent', 'dropshippers.procent_swan', 'dropshippers.procent_auction',
                'dropshippers.procent_30ml', 'dropshippers.earning', 'dropshippers.orders_total',
            )
            ->leftJoin('dropshippers','landing_orders.kod','=', 'dropshippers.kod')
            ->leftJoin('adv', 'adv.id','=', 'landing_orders.adv')
            ->where('landing_orders.status','=',8)
            ->where('landing_orders.dropshipper_payment','=',0)
            ->orderBy('dropshippers.kod')
            ->get()
            ->toArray();

        foreach ($orders as $order) {
            $dropshippers[$order->kod][] = $order;
        }

        foreach ($dropshippers as $orders) {

            $total    = 0;
            $earnings = 0;

            foreach ($orders as $order) {

                $kod    = $order->kod;
                $total += $order->sum;

                if ($order->swan == 1) {
                    $earnings += ($order->sum * $order->procent_swan / 100);

                } elseif ($order->adv_id == 244) {
                    $earnings += ($order->sum * $order->procent_auction / 100);

                } elseif ($order->adv_id == 246) {
                    $earnings += ($order->sum * $order->procent_auction / 100);

                } elseif ($order->adv_id == 262) {
                    $earnings += ($order->sum * $order->procent_30ml / 100);


                } else {
                    $earnings += ($order->sum * $order->procent / 100);
                }
            }

            //dd($earnings, $total);
            $shipper = Dropshipper::where('kod', $kod)->first();

            //dd($shipper, gettype($shipper));
            if($shipper && ($shipper->earning != $earnings || $shipper->orders_total != $total)) {
                $shipper->update([
                    'earning' => $earnings,
                    'orders_total' => $total,
                ]);
            }

        }

        return 0;
    }
}
