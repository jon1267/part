<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Dropshipper;
use App\Notifications\PassivePartnerNotification;
use Illuminate\Support\Facades\Notification;

/**
 * Class PassivePartner
 * посылает письмо (notification) партнерам (dropshippers) с признаками не активности:
 * зарегистрировались но нет домена, или с момента регистрации прошло 3 дня по (last_login)
 * @package App\Console\Commands
 */
class PassivePartner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passive:partner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email users who not active under partner program.';

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
        //выбираем партнеров, не выбравших домен и со времени создания прошло более 3 дней
        $partners = Dropshipper::where('domain','')
            ->whereDate('created', '<', Carbon::now()->subDays(3)->toDateTimeString())
            ->get();
        //dd($partners, count($partners));

        if (count($partners)) {
            Notification::send($partners, new PassivePartnerNotification());
        }

        echo "\n" . 'email send '. count($partners) . ' users';
        return 0;
    }
}
