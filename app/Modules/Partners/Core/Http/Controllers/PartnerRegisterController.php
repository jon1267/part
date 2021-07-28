<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerRegisterController extends Controller
{
    public function index()
    {
        return view('partners.register');
    }
}
