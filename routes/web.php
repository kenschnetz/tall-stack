<?php

    use App\Models\Subscriber as SubscriberModel;
    use Illuminate\Support\Facades\Route;

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

    Route::get('/subscribers/verify/{subscriber}', function(SubscriberModel $subscriber) {
        if(! $subscriber->hasVerifiedEmail()) {
            $subscriber->markEmailAsVerified();
        }
        return redirect('/?verified=1');
    })->middleware('signed')->name('subscribers.verify');

    require __DIR__ . '/auth.php';
