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
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/welcome', [PartnerCabinetController::class, 'index']);
Route::get('/cabinet', [PartnerCabinetController::class, 'cabinet'])->middleware(['auth'])->name('cabinet');
Route::get('/cabinet/profile', [PartnerCabinetController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::post('/cabinet/update-profile', [PartnerCabinetController::class, 'updateProfile'])->middleware(['auth'])->name('update.profile');
Route::get('/cabinet/how-to-earn', [PartnerCabinetController::class, 'howToEarn'])->name('cabinet.earn');

//это тестовый - после отладки писем убрать
//Route::get('/notify', [PartnerCabinetController::class, 'notify']);
