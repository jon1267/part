<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Front\Core\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
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


/* это стд. ларины роуты аутентификации и /home страницы после аутентиф.*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
