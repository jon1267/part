<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use App\Models\User;
use App\Models\Dropshipper;
use Illuminate\Foundation\Auth\RegistersUsers;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // this was in lara default
        //return Validator::make($data, [
        //    'name' => ['required', 'string', 'max:255'],
        //    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //    'password' => ['required', 'string', 'min:8', 'confirmed'],
        //]);

        // this our for table dropshippers (partners)
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
        // this was in lara default
        //return User::create([
        //    'name' => $data['name'],
        //    'email' => $data['email'],
        //    'password' => Hash::make($data['password']),
        //]);

        // this our for table dropshippers
        return Dropshipper::create([
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
            'kod_parent' => 0,
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
            'procent' => 0,
            'procent_swan' => 0,
            'procent_auction' => 0,
            'procent_30ml' => 0,
            'sub_procent' => 0,
            'earning' => 0,
            'orders_total' => 0,
            'facebook' => '',
            'code' => '',
            'price' => 0,
            'price50' => 0,
            'notification' => 0,
            'action_banner' => 0,
            'host' => config('app.host'),
            'manager' => 0,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? null,
        ]);
    }
}
