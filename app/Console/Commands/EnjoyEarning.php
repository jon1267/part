<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Dropshipper;
use App\Notifications\EnjoyEarningNotification;

class EnjoyEarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enjoy:earning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email users who has earnings more 200uah / 500rub';

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
        $partners = Dropshipper::where( [ ['host', '=' , 1], ['earning', '>=', 200] ] )
            ->orWhere( [ ['host', '=' , 2], ['earning', '>=', 500] ] )
            //->take(10)
            ->get();  //dd($partners, count($partners));


        foreach ($partners as $partner) {
            $partner->notify(new EnjoyEarningNotification($partner));
        }

        echo "\n" . 'Was found and try send email '. count($partners) . ' users';
        return 0;
    }
}
