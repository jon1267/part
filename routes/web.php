<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Front\Core\Http\Controllers\HomeController;
use App\Modules\Partners\Core\Http\Controllers\PartnerLoginController;
use App\Modules\Partners\Core\Http\Controllers\PartnerRegisterController;
use App\Modules\Partners\Core\Http\Controllers\PartnerCabinetController;

Route::get('/', [HomeController::class, 'index'])->name('front.index');
//Route::get('/page/update', [HomeController::class, 'update']);// not implement
Route::get('/policy',  [HomeController::class, 'policy'])->name('front.policy');
Route::get('/terms',   [HomeController::class, 'terms'])->name('front.terms');
Route::get('/thanks.html',  [HomeController::class, 'thanks']);
Route::post('/thanks.html', [HomeController::class, 'thanks']);
//->withoutMiddleware([VerifyCsrfToken::class]);// for example...
Route::get('/api/samples', [HomeController::class, 'samples']);
Route::post('/api/cities', [HomeController::class, 'cities']);
Route::post('/api/offices', [HomeController::class, 'offices']);
Route::post('/api/store', [HomeController::class, 'store']);
Route::post('/api/status', [HomeController::class, 'status']);
Route::post('/api/promocode', [HomeController::class, 'promocode']);

Route::get('/parfumes50',  [HomeController::class, 'parfumes50']);
Route::get('/parfumes100', [HomeController::class, 'parfumes100']);
Route::get('/parfumes500', [HomeController::class, 'parfumes500']);
Route::get('/product/{art}', [HomeController::class, 'productArt']);

//Route::get('/login', [PartnerLoginController::class, 'index']);
//Route::get('/enter', [PartnerLoginController::class, 'enter'])->name('enter');
Route::get('/reset', [PartnerLoginController::class, 'resetPassword']);
//Route::get('/register', [PartnerRegisterController::class, 'index'])->name('register');
//Route::post('/login', [PartnerLoginController::class, 'login'])->name('login');

/* это стд. ларины роуты аутентификации и /home страницы после аутентиф.*/
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', [PartnerCabinetController::class, 'index']);

Route::get('/cabinet', [PartnerCabinetController::class, 'cabinet'])->middleware(['auth'])->name('cabinet');
Route::get('/cabinet/profile', [PartnerCabinetController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::post('/cabinet/update-profile', [PartnerCabinetController::class, 'updateProfile'])->middleware(['auth'])->name('update.profile');
Route::get('/cabinet/how-to-earn', [PartnerCabinetController::class, 'howToEarn'])->middleware(['auth'])->name('cabinet.earn');
Route::get('/cabinet/material', [PartnerCabinetController::class, 'material'])->middleware(['auth'])->name('cabinet.material');
Route::post('/cabinet/create-site', [PartnerCabinetController::class, 'createSite'])->middleware(['auth'])->name('cabinet.create.site');
Route::get('/cabinet/orders', [PartnerCabinetController::class, 'orders'])->middleware(['auth'])->name('cabinet.orders');
Route::get('/cabinet/profit', [PartnerCabinetController::class, 'profit'])->name('cabinet.profit');
Route::get('/cabinet/visitka', [PartnerCabinetController::class, 'visitka'])->middleware(['auth'])->name('cabinet.visitka');

Route::get('/cabinet/subpartners', [PartnerCabinetController::class, 'subPartners'])->name('cabinet.subpartners');
Route::get('/cabinet/subpartners-orders', [PartnerCabinetController::class, 'subPartnersOrders'])->middleware(['auth'])->name('cabinet.subpartners.orders');

Route::get('/cabinet/contact-us', [PartnerCabinetController::class, 'contactUs'])->middleware(['auth'])->name('cabinet.contact-us');
Route::post('/cabinet/send-letter', [PartnerCabinetController::class, 'sendLetter'])->middleware(['auth'])->name('cabinet.send.letter');;

//это тестовый - после отладки писем убрать
//Route::get('/notify', [PartnerCabinetController::class, 'notify']);
