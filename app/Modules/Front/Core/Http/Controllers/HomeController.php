<?php

namespace App\Modules\Front\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dropshipper;
use Illuminate\Http\Request;
use App\Services\Sdek\Sdek;
use App\Services\Sdek\CurlSender;
use App\Modules\Front\Core\Tools\CreatePayment;
use App\Modules\Front\Core\Tools\ResponsePayment;

/**
 * Class HomeController
 * это аналог файла app\Controllers\Home.php из Code Igniter 4
 * (а не лариного HomeController, к-рый обычно есть контроллер стр. после удачной аутентификации)
 * те это - контроллер главной (фронтенд) страницы сайта (видима всем)
 * @package App\Modules\Front\Core\Http\Controllers
 */
class HomeController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function policy()
    {
        return view('front.policy');
    }

    public function terms()
    {
        return view('front.terms');
    }

    public function productArt($art)
    {
        $art = str_replace(['.html', '.htm'], ['',''], ucfirst($art)); // отрезали .html или .htm
        $art = str_replace('_','', strstr($art, '_')); // получили стр.типа W052-100, M017-500, AW015-8, PAS003-50
        $art_vol = explode('-', $art); // получаем $art && $volume
        $art = $art_vol[0];
        $volume = $art_vol[1];

        $productArt=[];
        $products = json_decode(file_get_contents('https://parfumdeparis.biz/page/json_tap'), true);

        if (count($products)) {
            foreach ($products as $product) {
                foreach ($product as $key => $value) {

                    // auto parfumes vol 8 ml
                    if ($value === $art.'-8' && (strpos($art,'A') !== false)) {
                        $productArt[] = [
                            'img' => '/files/'.$product['img'],//$art.'.png', //
                            'name' => str_replace('100ml','',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $product['text'],
                            'price' => $product['price100'] ?? 390,
                            'id' => $product['id'],
                            'art' => $art.'-'.$volume,
                            'link' => '/#auto',
                        ];
                    }
                    // Antiseptics & Parfumes Antiseptics
                    elseif ($value === $art && (strpos($art,'AS') !== false)) {
                        $productArt[] = [
                            'img' => '/files/'.$product['img'],//$art.'.png', //
                            'name' => str_replace('100ml','',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $product['text'],
                            'price' => $product['price100'] ?? 390,
                            'id' => $product['id'],
                            'art' => $art.'-'.$volume,
                            'link' => '/#septics',
                        ];
                    } elseif ($value === $art && $volume === '30') {
                        $productArt[] = [
                            'img' => '/files/plastic/'.$art.'.png',//$art.'.png',//$product['img'],
                            'name' => str_replace('100ml.','30ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => nl2br($product['text1']),//$product['text'],
                            'price' => 179,//$product['price25'] ??
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => substr($art, 0, 1) === 'W' ? '/#woman' : '/#man',

                        ];
                    } elseif ($value === $art && $volume === '50') {
                        $productArt[] = [
                            'img' => '/files/glass/'.$art.'.png',//'after'.$art.'.jpg',//$product['img'],
                            'name' => str_replace('100ml.','50ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => nl2br($product['text1']),//$product['text'],
                            'price' => $product['price50'] ?? 290,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => substr($art, 0, 1) === 'W' ? '/#woman50' : '/#man50',
                        ];
                    } elseif ($value === $art && $volume === '100' && (strpos($art,'AS') !== true)) {
                        $productArt[] = [
                            'img' => '/files/glass/'.$art.'.png',//'after'.$art.'.jpg',//$product['img'],
                            'name' => $product['name'],
                            'bname' => $product['bname'],
                            'text' => nl2br($product['text1']),//$product['text'],
                            'price' => $product['price100'] ?? 390,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => substr($art, 0, 1) === 'W' ? '/#woman100' : '/#man100',
                        ];
                    } elseif ($value === $art && $volume === '500') {
                        $productArt[] = [
                            'img' =>  '/files/'.$art.'-500.png',//$product['img'],
                            'name' => str_replace('100ml.','500ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => nl2br($product['text1']),//$product['text'],
                            'price' => 1390, // $product['price100'],
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => substr($art, 0, 1) === 'W' ? '/#woman500' : '/#man500',
                        ];
                    }

                }
            }
        }

        if ( ! count($productArt)) {
            abort(404);
        }

        return view('front.product-info', ['product' => $productArt[0], 'art' => $art]);
    }

    public function samples()
    {
        $products   = json_decode(file_get_contents('https://parfumdeparis.biz/page/json_tap'), true);
        $product30  = $this->getProducts30($products);
        $product50  = $this->getProducts50($products);
        $product100 = $this->getProducts100($products);
        $product500 = $this->getProducts500($products);
        $septics    = $this->getAntiSeptics($products);
        $auto       = $this->getAuto($products);
        $products = array_merge($product30, $product50, $product100, $product500, $septics, $auto);

        print json_encode($products);
    }

    public function cities(Request $request)
    {
        $keyword = $request->keyword;
        $rows    = file_get_contents('http://crm.kleopatra0707.com/api/novaposhta/cities?q=' . $keyword);

        print $rows;
    }

    public function offices(Request $request)
    {
        $cityId  = $request->cityId;
        $rows    = file_get_contents('http://crm.kleopatra0707.com/api/novaposhta/offices?ref=' . $cityId);

        print $rows;
    }

    public function officesRu(Request $request)
    {
        $sdek = new Sdek();

        $zip = trim($request->zip);
        $keyword = trim($request->keyword);
        $offices = $sdek->getPostOffices($zip);
        $rows = [];

        foreach ($offices as $office) {

            $pos = '';
            $name = $name = iconv('UTF-8', 'windows-1251//IGNORE', $office['name']); //$office['name']; //
            if (strpos($name, 'Постамат') !== false) {
                $pos = ' (Постамат)';
            }

            if (($keyword and strpos(mb_strtolower($office['address_full'], 'UTF-8'), mb_strtolower($keyword, 'UTF-8')) !== false) or !$keyword) {
                //print $office['code'] . ' - ' . iconv('UTF-8', 'windows-1251//IGNORE', str_replace(array('\'', '"'), '', $office['address_full'])) . ' (' . iconv('UTF-8', 'windows-1251//IGNORE', $office['postal_code']) . ')' . $pos . "\n";
                $rows[] =  $office['code'] . ' - ' . str_replace(array('\'', '"'), '', $office['address_full']) . ' (' . $office['postal_code'] . ')' . $pos;
            }

        }

        print json_encode($rows);
    }

    public function thanks(Request $request)
    {
        if ($request->get('order') AND $request->get('sum')) {
            $ch = curl_init('http://kleopatra0707.com/api/invoice');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                [
                    'amount'    => $request->get('sum'),
                    'order_id'  => $request->get('order')
                ]
            );

            $result = curl_exec($ch);
            curl_close($ch);

            if ($result) {
                return redirect()->to($result);
            }
        }

        $button = '';

        return view('front.thanks', ['button' => $button,] );
    }

    public function store(Request $request)
    {
        $message = '';
        $pay     = $request->pay;
        $kindpay = $request->kindpay;

        $kod = 0;
        $subDomain = '';
        $parseUrl = parse_url(url()->current());
        if (isset($parseUrl['host'])) {
            if(substr_count($parseUrl['host'],'.') >= 2) {
                $subDomain = strstr($parseUrl['host'], '.', true);
            }
        }

        if ($subDomain != '' && $subDomain != 'partner') {
            $partner = Dropshipper::where('domain', $subDomain)
                ->where('host', config('app.host'))
                ->first();

            if ($partner) {
                $kod = $partner->kod;
            }
        }

        $baskets = [];
        if ($request->basket) {
            $baskets = json_decode($request->basket, true);
        }

        if (count($baskets) === 0) {
            return false;
        }

        $status        = 0;
        $statuscallid  = 0;
        $statuspackage = 0;

        if ($pay == 'Отделение' AND $kindpay == 1) {
            $statuscallid = 7;
            $message .= 'Оформлен (доставка на отделение). Оплата онлайн';
        }

        if ($pay == 'Курьером' AND $kindpay == 1) {
            $statuscallid = 9;
            $message .= 'Адресная доставка курьером. Оплата онлайн';
        }

        if ($pay == 'Отделение' AND $kindpay == 2) {
            $statuspackage = 1;
            $statuscallid = 7;
            $status = 1;
            $message .= 'Доставка Новая Почта. Оплата при получении.';
        }

        if ($pay == 'Курьером' AND $kindpay == 2) {
            $statuspackage = 1;
            $statuscallid = 9;
            $status = 1;
            $message .= 'Адресная доставка курьером. Оплата при получении.';
        }

        $name = implode(' ', [
                $request->name,
                $request->lastname,
                $request->prelastname,
            ]
        );

        $sum = 0;
        $products = '';
        $currency = config('app.host') == 1 ? 'грн' : 'руб';
        foreach($baskets as $item) {
            $sum += $item['sale'];
            $products .= $item['art'] . ' ' . $item['bname'] . ' (' . $item['name'] . ')' . ', ' . $item['sale'] . ' '.$currency.' ' . $item['qty'].' ед / ';
        }

        $adv = 170;
        if (config('app.host') == 1) {
            if ($kod) {
                $adv = 173;
            }
        }

        if (config('app.host') == 2) {
            $adv = 203;
            if ($kod) {
                $adv = 205;
            }
        }

        try {
            $ch = curl_init('http://kleopatra0707.com/getorderlanding');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                [
                    'product'       => $products,
                    'status'        => $status,
                    'statuscallid'  => $statuscallid,
                    'statuspackage' => $statuspackage,
                    'name'          => $name,
                    'mess'          => $message,
                    'city'          => $request->city,
                    'adres'         => $request->office,
                    'street'        => $request->street,
                    'house'         => $request->house,
                    'flat'          => $request->flat,
                    'phone'         => $request->tel,
                    'sum'           => $sum,
                    'host'          => $_SERVER['HTTP_HOST'],
                    'adv'           => $adv,
                    'ip'            => request()->ip(),
                    'useragent'     => request()->userAgent(),
                    'kod'           => $kod,

                ]
            );
            $crm_order_id = curl_exec($ch);
            curl_close($ch);

        } catch (\Exception $e) {
            echo 'ORDDER NOT SENT ID' . $e->getMessage();
        }

        print $crm_order_id;
    }

    public function promocode()
    {
        $ch = curl_init('http://kleopatra0707.com/api/promocode');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            [
                'promocode' => $this->request->getPost('promocode'),
                'site'      => $this->request->getPost('site'),
            ]
        );
        $result = curl_exec($ch);
        curl_close($ch);

        print $result;
    }

    private function getProducts30($products)
    {
        $output = [];
        $counts = ['man30' => 0, 'woman30' => 0];
        $category = '';

        foreach ($products as $product)
        {
            if (($product['man'] === '1' || $product['woman'] === '1') AND $this->getActivePlatform($product)) {

                if ($product['man'] === '1') {
                    $counts['man30']++;
                    $category = 'man30';
                }

                if ($product['woman'] === '1') {
                    $counts['woman30']++;
                    $category = 'woman30';
                }

                $price = config('app.host') == 1 ? 179 : 490;

                $output[] = [
                    'category' => $product['woman'] ? 1 : 2,
                    'img' => '/files/plastic300/' . $product['art100'] . '.jpg',
                    'name' => (strpos($product['name'], '100ml.') === false) ? $product['name'] . ' 30ml' : str_replace('100ml.', '30ml', $product['name']),
                    'bname' => $product['bname'],
                    'price' => $price,
                    'art' => $product['art100'] . '-30',// add Jon it need card info
                    'man' => $product['man'],
                    'woman' => $product['woman'],
                    'volume' => 30,
                    'filter2' => $product['filters'],
                    'show' => ($counts[$category] <= 12) ? 1 : 0,
                    'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', trim(strtolower($product['bname'])) . '-' . trim(strtolower($product['name']))),
                    'new' => $product['new'],
                    'hit' => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getProducts50($products)
    {
        $output = [];
        $counts = ['man50' => 0, 'woman50' => 0];
        $category = '';

        foreach ($products as $product) {

            if (($product['man'] === '1' || $product['woman'] === '1') AND $this->getActivePlatform($product)) {

                if ($product['man'] === '1') {
                    $counts['man50']++;
                    $category = 'man50';
                }

                if ($product['woman'] === '1') {
                    $counts['woman50']++;
                    $category = 'woman50';
                }

                $price = config('app.host') == 1 ? $product['price50'] : 1090;

                $output[] = [
                    'category' => $product['woman'] ? 3 : 4,
                    'img' => '/files/glass300/' . $product['art100'] . '.jpg',//'after'.$product['art100'].'.jpg',//$product['img'],
                    'name' => (strpos($product['name'], '100ml.') === false) ? $product['name'] . ' 50ml' : str_replace('100ml.', '50ml', $product['name']),
                    'bname' => $product['bname'],
                    'price' => $price,
                    'art' => $product['art100'] . '-50',// add Jon it need card info
                    'man' => $product['man'],
                    'woman' => $product['woman'],
                    'volume' => 50,
                    'filter2' => $product['filters'],
                    'show' => ($counts[$category] <= 12) ? 1 : 0,
                    'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', trim(strtolower($product['bname'])) . '-' . trim(strtolower($product['name']))),
                    'new' => $product['new'],
                    'hit' => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getProducts100($products)
    {
        $output = [];
        $counts = ['man100' => 0, 'woman100' => 0];
        $category = '';

        foreach ($products as $product)
        {
            if (($product['man'] ==='1' || $product['woman'] === '1') AND $this->getActivePlatform($product)) {

                if ($product['man'] === '1') {
                    $counts['man100']++;
                    $category = 'man100';
                }

                if ($product['woman'] === '1') {
                    $counts['woman100']++;
                    $category = 'woman100';
                }

                $price = config('app.host') == 1 ? $product['price100'] : 1590;

                $output[] = [
                    'category' => $product['woman'] ? 5 : 6,
                    'img' => '/files/glass300/' . $product['art100'] . '.jpg',//'after'.$product['art100'].'.jpg',// $product['img'],  // W065.png M006.png
                    'name' => $product['name'],
                    'bname' => $product['bname'],
                    'price' => $price,

                    'art' => $product['art100'] . '-100',

                    'man' => $product['man'],
                    'woman' => $product['woman'],
                    'volume' => 100,

                    'filter2' => $product['filters'],
                    'show' => ($counts[$category] <= 12) ? 1 : 0,
                    'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', trim(strtolower($product['bname'])) . '-' . trim(strtolower($product['name']))),
                    'new' => $product['new'],
                    'hit' => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getProducts500($products)
    {
        $output = [];

        $counts = ['woman500' => 0, 'man500' => 0];
        $category = '';
        $volume = 500;

        foreach ($products as $product) {

            if (($product['man500'] ==='1' || $product['woman500'] === '1') AND $this->getActivePlatform($product)) {

                if ($product['man500'] === '1') {
                    $counts['man500']++;
                    $category = 'man500';

                }
                if ($product['woman500'] === '1') {
                    $counts['woman500']++;
                    $category = 'woman500';
                }

                $price = config('app.host') == 1 ? $product['price100'] : 4490;

                $output[] = [
                    'category' => $product['woman500'] ? 7 : 8,
                    'img'    => '/files/'.$product['art100'].'.png',
                    'name'   => $product['name'],
                    'bname'  => $product['bname'],
                    'price'  => $price,
                    'volume' => $volume,
                    'art'    => $product['art100'],
                    'man'    => $product['man500'],
                    'woman'  => $product['woman500'],
                    'filter2'=> $product['filters'],
                    'show'   => ($counts[$category] <= 12) ? 1 : 0,
                    'slug'   => preg_replace('/[^A-Za-z0-9-]+/', '-',  trim(strtolower($product['bname'])).'-'.trim(strtolower($product['name']))),
                    'new'    => $product['new'],
                    'hit'    => $product['hit'],
                ];
            }
        }
        return $output;
    }

    private function getAntiSeptics($products)
    {
        $output = [];
        $index = 0;

        foreach ($products as $product)
        {
            if ($product['antiseptics'] === '1' AND  $this->getActivePlatform($product))
            {
                $index++;

                $output[] = [
                    'category' => 9,
                    'img'      => '/files/'.$product['img'],
                    'name'     => $product['name'],
                    'bname'    => $product['bname'],
                    'price'    => $product['price100'],
                    'art'      => $product['art100'].'-50',
                    'volume'   => 50,
                    'filter2'  => $product['filters'],
                    'show'     => $index <= 12 ? 1 : 0,
                    'slug'     => preg_replace('/[^A-Za-z0-9-]+/', '-',  trim(strtolower($product['bname'])).'-'.trim(strtolower($product['name']))),
                    'new'      => $product['new'],
                    'hit'      => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getAuto($products)
    {
        $output = [];
        $index = 0;

        foreach ($products as $product)
        {
            if ($product['auto'] === '1' AND $this->getActivePlatform($product))
            {
                $index++;

                $output[] = [
                    'category' => 10,
                    'img'      => '/files/'.$product['img'],
                    'name'     => $product['name'],
                    'bname'    => $product['bname'],
                    'price'    => $product['price100'],
                    'art'      => $product['art100'],
                    'volume'   => 8,
                    'filter2'  => $product['filters'],
                    'show'     => $index <= 12 ? 1 : 0,
                    'slug'     => preg_replace('/[^A-Za-z0-9-]+/', '-',  trim(strtolower($product['bname'])).'-'.trim(strtolower($product['name']))),
                    'new'      => $product['new'],
                    'hit'      => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getActivePlatform($product)
    {
        return (config('app.host') === '1') ?
            ($product['active_ua'] === '1' AND $product['active'] === '1') :
            ($product['active_ru'] === '1' AND $product['active'] === '1') ;
    }

    public function parfumes50()
    {
        return view('front.parfumes-50');
    }

    public function parfumes100()
    {
        return view('front.parfumes-100');
    }

    public function parfumes500()
    {
        return view('front.parfumes-500');
    }
}
