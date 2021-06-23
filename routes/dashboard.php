<?php

    use App\Models\Subscriber as SubscriberModel;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('subscribers', function() {
        return view('subscribers.all')->with(['subscribers' => SubscriberModel::all()]);
    })->name('subscribers.all');
