<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use App\Models\User;
use App\Models\Dropshipper;
use Illuminate\Foundation\Auth\RegistersUsers;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Modules\Partners\Core\Events\PartnerRegisterd;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/cabinet';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('partners.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dropshippers'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $kodParent = 0;
        $subDomain = '';
        $parseUrl = parse_url(url()->current());
        if (isset($parseUrl['host'])) {
            if(substr_count($parseUrl['host'],'.') >= 2) {
                $subDomain = strstr($parseUrl['host'], '.', true);
            }
        }

        if (($subDomain != '') && ($subDomain != 'partner')) {
            $partner = Dropshipper::where('domain', $subDomain)
                ->where('host', config('app.host'))
                ->first();

            if ($partner) {
                $kodParent = $partner->kod;
            }
        }

        // this our for table dropshippers
        $partner = Dropshipper::create([
            'name' => $data['name'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'pass' => md5($data['password'], false),
            'kod' => mt_rand(10000000,99999999),
            // --- имхо многое (все остальное) сделать nullable ?
            'soc' => '',
            'skidka' => 0,
            'country' => '',
            'city' => '',
            'text' => '',
            'kod_parent' => $kodParent,
            'webmoney' => '',
            'bank' => '',
            'shorturl' => '',
            'reset' => '',
            'parfum' => 0,
            'domain' => '',
            'numlogins' => 0,
            'created' => date('Y-m-d'),
            'last_login' => date('Y-m-d H:i:s'),
            'orders' => 0,
            'procent' => 20,
            'procent_swan' => 20,
            'procent_auction' => 20,
            'procent_30ml' => 20,
            'sub_procent' => 2,
            'earning' => 0,
            'orders_total' => 0,
            'facebook' => '',
            'code' => '',
            'price' => 0,
            'price50' => 0,
            'notification' => 1,
            'action_banner' => 0,
            'host' => config('app.host'),
            'manager' => 0,
            'ip' => request()->ip()
        ]);

        event(new PartnerRegisterd($partner));

        return $partner;

    }

}
