<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/coupon', function () {
    auth()->user()->redeemCoupon('welcome', 'main', false);
    return redirect('/dashboard')->with('status', 'Coupon redeemed.');
})->name('coupon');

Route::middleware(['auth:sanctum', 'verified'])->get('/subscribe', function () {
    return view('subscribe');
})->name('subscribe');

Route::middleware(['auth:sanctum', 'verified'])->post('/subscribe', function (Request $request) {
    $user = auth()->user();
    $plan = $request->plan;

    $name = 'main';

    if(!$user->subscribed($name, $plan)) {

        $result = $user->newSubscription($name, $plan)->create();

        if(is_a($result, RedirectToCheckoutResponse::class)) {
            return $result; // Redirect to Mollie checkout
        }

        return redirect('/dashboard')->with('status', 'Welcome to the ' . $plan . ' plan');
    }

    return redirect('/dashboard')->with('status', 'You are already on the ' . $plan . ' plan');
})->name('subscribe.post');
