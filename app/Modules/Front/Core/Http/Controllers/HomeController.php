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
        $policy = app()->getLocale() === "ua" ? 'front.policy_ua' : 'front.policy';
        return view($policy);
    }

    public function terms()
    {
        $terms = app()->getLocale() === "ua" ? 'front.terms_ua' : 'front.terms';
        return view($terms);
    }

    public function offers()
    {
        $offers = app()->getLocale() === "ua" ? 'front.offers_ua' : 'front.offers';
        return view($offers);
    }

    public function productArt($art)
    {
        $art = str_replace(['.html', '.htm'], ['',''], ucfirst($art));
        $art = str_replace('_','', strstr($art, '_'));
        $art_vol = explode('-', $art);
        $art = $art_vol[0];
        $volume = $art_vol[1] ?? '100';

        $productArt = [];
        $products = json_decode(file_get_contents('https://parfumdeparis.biz/page/json_tap_text'), true);
        $ua = app()->getLocale() === 'ua';
        $uaPrefix = app()->getLocale() === 'ua' ? '/ua' : '/';

        // новая цена только для тап версии
        $price    = config('app.host') == 1 ? 179 : 490;
        $price50  = config('app.host') == 1 ? 390 : 1090;
        $price100 = config('app.host') == 1 ? 590 : 1590;

        if (count($products)) {
            foreach ($products as $product) {
                foreach ($product as $key => $value) {

                    // auto parfumes vol 8 ml
                    if ($value === $art.'-8' && (strpos($art,'A') !== false)) {
                        $productArt[] = [
                            'img' => '/files/glass/'.$art.'.jpg',
                            'name' => str_replace('100ml','',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? $product['text_ua'] : $product['text'],
                            'price' => $product['price100'] ?? 390,
                            'id' => $product['id'],
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . '#auto',
                        ];
                    }
                    // Antiseptics & Parfumes Antiseptics
                    elseif ($value === $art && (strpos($art,'AS') !== false)) {
                        $productArt[] = [
                            'img' => '/files/glass/'.$art.'.jpg',
                            'name' => str_replace('100ml','',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? $product['text_ua'] : $product['text'],
                            'price' => $product['price100'] ?? 390,
                            'id' => $product['id'],
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . '#septics',
                        ];
                    }
                    // Parfumes Gel for Bathroom vol 250 ml
                    elseif ($value === $art && (strpos($art,'GEL') !== false)) {
                        $productArt[] = [
                            'img' => '/files/glass/'.$art.'.jpg',
                            'name' => str_replace('100ml','',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? $product['text_ua'] : $product['text'],
                            'price' => $product['price100'],
                            'id' => $product['id'],
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . '#gel',
                        ];
                    }
                    elseif ($value === $art && $volume === '30') {
                        $productArt[] = [
                            'img' => '/files/plastic/'.$art.'.jpg',
                            'name' => str_replace('100ml.','30ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? nl2br($product['text1_ua']) : nl2br($product['text1']),
                            'price' => $price, //179,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . (substr($art, 0, 1) === 'W' ? '#woman' : '#man'),

                        ];
                    } elseif ($value === $art && $volume === '50') {
                        $productArt[] = [
                            'img' => config('app.host') == 1 ? '/files/glass-50-1000/'.$art.'.jpg' : '/files/glass/'.$art.'.jpg',
                            'name' => str_replace('100ml.','50ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? nl2br($product['text1_ua']) : nl2br($product['text1']),
                            'price' => $price50, //$product['price50'] ?? 290,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . (substr($art, 0, 1) === 'W' ? '#woman' : '#man'),
                        ];
                    } elseif ($value === $art && $volume === '100' && (strpos($art,'AS') !== true)) {
                        $productArt[] = [
                            'img' => config('app.host') == 1 ? '/files/glass-100-1000/'.$art.'.jpg' : '/files/glass/'.$art.'.jpg',
                            'name' => $product['name'],
                            'bname' => $product['bname'],
                            'text' => $ua ? nl2br($product['text1_ua']) : nl2br($product['text1']),
                            'price' => $price100, //$product['price100'] ?? 390,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art,
                            'link' => $uaPrefix . (substr($art, 0, 1) === 'W' ? '#woman' : '#man'),
                        ];
                    } elseif ($value === $art && $volume === '500') {
                        $productArt[] = [
                            'img' =>  '/files/glass500/'.$art.'-500.png',
                            'name' => str_replace('100ml.','500ml',$product['name']),
                            'bname' => $product['bname'],
                            'text' => $ua ? nl2br($product['text1_ua']) : nl2br($product['text1']),
                            'price' => 1390,
                            'id' => $product['id'],
                            'volume' => $volume,
                            'art' => $art.'-'.$volume,
                            'link' => $uaPrefix . (substr($art, 0, 1) === 'W' ? '#woman500' : '#man500'),
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
        $data= json_decode(file_get_contents('https://parfumdeparis.biz/page/json_tap'), true);

        print json_encode(array_merge(
                $this->getProducts($data),
                $this->getAntiSeptics($data),
                $this->getAuto($data),
                $this->getGel($data)
            )
        );
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
        $zip = trim($request->zip);
        $keyword = trim($request->keyword);

        $rows = file_get_contents('http://crm.kleopatra0707.com/api/sdek/offices?zip=' . $zip .'&keyword=' . $keyword);

        print $rows;
    }

    public function thanks(Request $request)
    {
        if ($request->get('order') AND $request->get('sum')) {
            $ch = curl_init('http://kleopatra0707.com/api/invoice');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                [
                    'amount'    => round($request->get('sum')),
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
        $noCall  = $request->nocall;

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
            if ($noCall) {
                $statuspackage = 1;
                $status = 1;
            }

            $statuscallid = 7;
            $message .= 'Доставка Новая Почта. Оплата при получении.';
        }

        if ($pay == 'Курьером' AND $kindpay == 2) {
            if ($noCall) {
                $statuspackage = 1;
                $status = 1;
            }

            $statuscallid = 9;
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

        foreach ($baskets as $item) {

            $sum += $item['total'];

            if ($item['qty'] == 1 AND $item['total'] != $item['sale'] * $item['qty']) {

                $item['sale'] = 0;
                $products .= $item['art'] . ' ' . $item['bname'] . ' (' . $item['name'] . ')' . ', ' . $item['sale'] . ' ' . $currency . ' ' . $item['qty']. ' ед / ';

            } elseif ($item['qty'] > 1 AND $item['total'] != $item['sale'] * $item['qty']) {

                $fullTotal = $item['sale'] * $item['qty'];
                $total     = $item['total'];
                $diff      = $fullTotal - $total;
                $freeQty   = $diff / $item['sale'];
                $qty       = $item['qty'] - $freeQty;

                $products .= $item['art'] . ' ' . $item['bname'] . ' (' . $item['name'] . ')' . ', 0 ' . $currency. ' ' . $freeQty . ' ед / ';
                $products .= $item['art'] . ' ' . $item['bname'] . ' (' . $item['name'] . ')' . ', ' . $item['sale'] . ' ' . $currency.' ' . $qty . ' ед / ';

            } else {

                $products .= $item['art'] . ' ' . $item['bname'] . ' (' . $item['name'] . ')' . ', ' . $item['sale'] . ' ' . $currency.' ' . $item['qty'] . ' ед / ';

            }
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

        if ($kindpay == 1) {
            $sum = round($sum - ($sum * 0.1));
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

    private function getProducts($products)
    {
        $output = [];
        $counts = ['man' => 0, 'woman' => 0];
        $category = '';

        foreach ($products as $product) {

            if (($product['man'] === '1' || $product['woman'] === '1') AND $this->getActivePlatform($product)) {

                if ($product['man'] === '1') {
                    $counts['man']++;
                    $category = 'man';
                }

                if ($product['woman'] === '1') {
                    $counts['woman']++;
                    $category = 'woman';
                }

                $price    = config('app.host') == 1 ? 179 : 490;
                //$price50  = config('app.host') == 1 ? $product['price50'] : 1090;
                //$price100 = config('app.host') == 1 ? $product['price100'] : 1590;
                $price50  = config('app.host') == 1 ? 390 : 1090;
                $price100 = config('app.host') == 1 ? 590 : 1590;

                $row = [
                    'img' => '/files/plastic300/' . $product['art100'] . '.jpg',
                    'name' => (strpos($product['name'], '100ml.') === false) ? $product['name'] : str_replace('100ml.', '', $product['name']),
                    'bname' => $product['bname'],
                    'price' => $price50,
                    'art' => $product['art100'] . '-30',
                    'man' => $product['man'],
                    'woman' => $product['woman'],
                    'volume' => 30,
                    'filter2' => (\request()->get('lang') === 'ru') ? $product['filters'] : $product['filters_ua'],
                    'show' => ($counts[$category] <= 32) ? 1 : 0,
                    'slug' => preg_replace('/[^A-Za-z0-9-]+/', '-', trim(strtolower($product['bname'])) . '-' . trim(strtolower($product['name']))),
                    'new' => $product['new'],
                    'hit' => $product['hit'],
                    'variants' => [
                        [
                            'volume'   => 30,
                            'art'   => $product['art100'] . '-30',
                            'price' => $price,
                            'img'   => '/files/plastic300/' . $product['art100'] . '.jpg',
                            'img1000'   => '/files/plastic/' . $product['art100'] . '.jpg',
                        ],
                        [
                            'volume'   => 50,
                            'art'   => $product['art100'] . '-50',
                            'price' => $price50,
                            'img'   => config('app.host') == 1 ? '/files/glass-50-350/' . $product['art100'] . '.jpg' : '/files/glass300/' . $product['art100'] . '.jpg',
                            'img1000'   => config('app.host') == 1 ? '/files/glass-50-1000/' . $product['art100'] . '.jpg' : '/files/glass/' . $product['art100'] . '.jpg',
                        ],
                        [
                            'volume'   => 100,
                            'art'   => $product['art100'],
                            'price' => $price100,
                            'img'   => config('app.host') == 1 ? '/files/glass-100-350/' . $product['art100'] . '.jpg' : '/files/glass300/' . $product['art100'] . '.jpg',
                            'img1000'   => config('app.host') == 1 ? '/files/glass-100-1000/' . $product['art100'] . '.jpg' : '/files/glass/' . $product['art100'] . '.jpg',
                        ],
                    ]
                ];

                $output[$product['art100']] = $row;
            }
        }

        foreach ($products as $product) {
            if (($product['man500'] === '1' || $product['woman500'] === '1') AND $this->getActivePlatform($product)) {
                $art = str_replace('-500', '', $product['art100']);
                if (isset($output[$art])) {
                    $output[$art]['variants'][] = [
                        'volume' => 500,
                        'art'    => $product['art100'],
                        'price'  => config('app.host') == 1 ? $product['price100'] : 4490,
                        'img'    => '/files/glass500/' . $product['art100'].'.png',
                        'img1000'=> '/files/glass500/' . $product['art100'].'.png',
                    ];
                }
            }
        }

        return array_values($output);
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
                    'filter2'  => (\request()->get('lang') === 'ru') ? $product['filters'] : $product['filters_ua'],
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
                    'filter2'  => (\request()->get('lang') === 'ru') ? $product['filters'] : $product['filters_ua'],
                    'show'     => $index <= 12 ? 1 : 0,
                    'slug'     => preg_replace('/[^A-Za-z0-9-]+/', '-',  trim(strtolower($product['bname'])).'-'.trim(strtolower($product['name']))),
                    'new'      => $product['new'],
                    'hit'      => $product['hit'],
                ];
            }
        }

        return $output;
    }

    private function getGel($products)
    {
        $output = [];
        $index = 0;

        foreach ($products as $product)
        {
            if (strpos($product['art100'], 'GEL') !== false AND $this->getActivePlatform($product))
            {
                $index++;

                $output[] = [
                    'category' => 11,
                    'img'      => '/files/'.$product['img'],
                    'name'     => $product['name'],
                    'bname'    => $product['bname'],
                    'price'    => $product['price100'],
                    'art'      => $product['art100'].'-250',
                    'volume'   => 250,
                    'filter2'  => (\request()->get('lang') === 'ru') ? $product['filters'] : $product['filters_ua'],
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
        return (config('app.host') === '1')
            ? ($product['active_ua'] === '1' AND $product['active'] === '1')
            : ($product['active_ru'] === '1' AND $product['active'] === '1') ;
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

    public function  parfumman(Request $request)
    {
        $ip = isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        $ch = curl_init('http://kleopatra0707.com/getorderlanding');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            [
                'product'   => '',
                'phone'     => $request->post('tel'), //'phone' => $this->input->post('tel', TRUE),
                'sum'       => 0,
                'mess'      => 'Подбор аромата',
                'host'      => $_SERVER['HTTP_HOST'],
                'adv'       => config('app.host') == 1 ? 391 : 392,
                'ip'        => $ip,
                'useragent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            ]
        );
        $crm_order_id = curl_exec($ch);
        curl_close($ch);
    }
}
