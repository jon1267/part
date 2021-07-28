<?php

namespace App\Modules\Partners\Core\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\Dropshipper;

class PartnerCabinetController extends Controller
{
    public function cabinet()
    {
        return view('adminlte.admin');
        //return view('partners.cabinet');
    }

    public function profile()
    {

    }
}
