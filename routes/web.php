<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\UrlGenerator;

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

// Route::get('/', function () {
//     return redirect('/docs');
// });
Route::get('/', function () {
    return redirect('/docs');
});

// Route::get('/test', function () {
//     // return url()->full();
//     return 'Raggiunta la TEST';
//     return view('welcoa2endme');
// });