<?php

use Illuminate\Support\Facades\Route;
use App\Events\MessageSent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trigger/{msg}', function ($msg) {
    event(new MessageSent($msg));
    return response()->json(['status' => 'Message sent!']);
})->name('trigger');

Route::get('/debug-config', function () {
    return [
        'key' => env('REVERB_APP_KEY'),
        'host' => env('REVERB_HOST'),
        'port' => env('REVERB_PORT'),
        'scheme' => env('REVERB_SCHEME'),
    ];
});

Route::get('/test-pusher', function () {
    return view('test-pusher');
});
