<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

Route::fallback(function () {
    return redirect()->back();
});

Route::get("/", [App\Http\Controllers\LandingPageController::class, 'render'])->name('landing_page');

// Social Media Account
Route::get('/facebook', function () {
    return redirect('https://facebook.com');
})->name('facebook');
Route::get('/instagram', function () {
    return redirect('https://instagram.com');
})->name('instagram');
Route::get('/twitter', function () {
    return redirect('https://twitter.com');
})->name('twitter');

// User tidak perlu autentikasi
Route::prefix('/auth')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'render'])->name('login');
    Route::post('/login/commit', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('login.commit');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'render_page'])->name('register');
    Route::post('/register/submit', [App\Http\Controllers\Auth\RegisterController::class, 'registerSubmit'])->name('register.submit');
});

// Route untuk download aseet
Route::get('/download/{name}', function ($name) {
    return response()->download('storage/' . $name);
})->name('download');

// User Terautentikasi

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Untuk sisi Admin
    Route::middleware(App\Http\Middleware\CheckUserRole::class)->prefix('/admin')->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\DashboardController::class, 'render'])->name('dashboard.admin');
        });
        Route::prefix('/carlist')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\CarController::class, 'render'])->name('carlist.admin');
            Route::get('/create', [App\Http\Controllers\Admin\CarController::class, 'createrender'])->name('carlist.create');
            Route::post('/create/submit', [App\Http\Controllers\Admin\CarController::class, 'create'])->name('carlist.create.submit');
            Route::get('/edit/render/{id}', [App\Http\Controllers\Admin\CarController::class, 'editrender'])->name('carlist.edit.render');
            Route::post('/edit/commit/{id}',[App\Http\Controllers\Admin\CarController::class, 'update'])->name('carlist.update.commit');
            Route::delete('/delete', [App\Http\Controllers\Admin\CarController::class, 'delete'])->name('carlist.delete');
        });
        Route::prefix('/order')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\QueueOrderController::class, 'index'])->name('queue.index');
            Route::put('/confirm', [App\Http\Controllers\Admin\QueueOrderController::class, 'confirm'])->name('queue.confirm');
            Route::put('/confirm_to_return', [App\Http\Controllers\Admin\QueueOrderController::class, 'confirmToReturn'])->name('confirm.return');
        });
    });


    //Untuk sisi tenant
    Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'render'])->name('dashboard.client');
    Route::get('/rent/index', [App\Http\Controllers\Client\RentController::class, 'render'])->name('rentcar');
    Route::get('/rent/detail', [App\Http\Controllers\Client\RentController::class,'rent'])->name('rent.details');
    Route::post('/rent/confirm', [App\Http\Controllers\Client\RentController::class,'confirm'])->name('rent.confirm');
    Route::get('/rent/payment/index',[App\Http\Controllers\Payments\RentalPaymentController::class, 'payment_page'])->name('rent.payment');
    Route::get('/rent/payment/{status}', [App\Http\Controllers\Payments\RentalPaymentController::class, 'successPay'])->name('rent.payment.success');
    Route::put('/rent/update_renting', [App\Http\Controllers\Admin\QueueOrderController::class,'orderStatusRenting'])->name('rent.rentingStatus');
    Route::put('/rent/cancel', [App\Http\Controllers\Client\RentController::class, 'cancel'])->name('rent.cancel');
    Route::put('/rent/return', [App\Http\Controllers\Client\RentController::class, 'returning'])->name('rent.return');
});
