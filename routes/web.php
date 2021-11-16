<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Front\Core\Http\Controllers\HomeController;
use App\Modules\Front\Core\Http\Controllers\LanguageController;
use App\Modules\Partners\Core\Http\Controllers\PartnerCabinetController;
use App\Modules\Payment\Core\Http\Controllers\PartnerPaymentController;

Route::get('/lang/{lang}',   [LanguageController::class, 'update'])->name('language.update');
Route::post('/thanks.html', [HomeController::class, 'thanks']);

Route::group(['middleware' => 'language.ru'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('front.index');
    Route::get('/thanks.html', [HomeController::class, 'thanks'])->name('front.thanks');
    Route::get('/product/{art}', [HomeController::class, 'productArt'])->name('front.product');
    Route::get('/policy', [HomeController::class, 'policy'])->name('front.policy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('front.terms');
});

Route::group(['middleware' => 'language.ua'], function () {
    Route::get('/ua', [HomeController::class, 'index'])->name('ua.front.index');
    Route::get('/ua/thanks.html',  [HomeController::class, 'thanks'])->name('ua.thanks');
    Route::get('/ua/product/{art}', [HomeController::class, 'productArt'])->name('ua.front.product');
    Route::get('/ua/policy',  [HomeController::class, 'policy'])->name('ua.front.policy');
    Route::get('/ua/terms',   [HomeController::class, 'terms'])->name('ua.front.terms');
});

Route::get('/api/samples', [HomeController::class, 'samples']);
Route::post('/api/cities', [HomeController::class, 'cities']);
Route::post('/api/offices', [HomeController::class, 'offices']);
Route::post('/api/store', [HomeController::class, 'store']);
Route::post('/api/status', [HomeController::class, 'status']);
Route::post('/api/promocode', [HomeController::class, 'promocode']);
Route::post('/api/offices-ru', [HomeController::class, 'officesRu']);
Route::post('/api/parfumman', [HomeController::class, 'parfumman']);

#Route::get('/parfumes50',  [HomeController::class, 'parfumes50']);
#Route::get('/parfumes100', [HomeController::class, 'parfumes100']);
#Route::get('/parfumes500', [HomeController::class, 'parfumes500']);
#Route::get('/welcome', [PartnerCabinetController::class, 'index']);

Auth::routes();
Route::get('/password/reset/{token}/{email}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/welcome', [PartnerCabinetController::class, 'index'])->name('welcome');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/cabinet', [PartnerCabinetController::class, 'cabinet'])->name('cabinet');
    Route::get('/cabinet/profile', [PartnerCabinetController::class, 'profile'])->name('profile');
    Route::post('/cabinet/update-profile', [PartnerCabinetController::class, 'updateProfile'])->name('update.profile');
    Route::get('/cabinet/how-to-earn', [PartnerCabinetController::class, 'howToEarn'])->name('cabinet.earn');
    Route::get('/cabinet/material', [PartnerCabinetController::class, 'material'])->name('cabinet.material');
    Route::post('/cabinet/create-site', [PartnerCabinetController::class, 'createSite'])->name('cabinet.create.site');
    Route::get('/cabinet/orders', [PartnerCabinetController::class, 'orders'])->name('cabinet.orders');
    Route::get('/cabinet/profit', [PartnerCabinetController::class, 'profit'])->name('cabinet.profit');
    Route::get('/cabinet/visitka', [PartnerCabinetController::class, 'visitka'])->name('cabinet.visitka');
    Route::get('/cabinet/subpartners', [PartnerCabinetController::class, 'subPartners'])->name('cabinet.subpartners');
    Route::get('/cabinet/subpartners-orders', [PartnerCabinetController::class, 'subPartnersOrders'])->name('cabinet.subpartners.orders');
    Route::get('/cabinet/contact-us', [PartnerCabinetController::class, 'contactUs'])->name('cabinet.contact-us');
    Route::post('/cabinet/send-letter', [PartnerCabinetController::class, 'sendLetter'])->name('cabinet.send.letter');
    Route::post('/cabinet/request-payment-mail', [PartnerPaymentController::class, 'requestPayment'])->name('cabinet.request.payment');
});
