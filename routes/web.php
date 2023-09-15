<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/test', function () {
    // return view('welcome');

    $user = User::find(2);
    dd($tenant);
    // return redirect('admin/login');
});

Route::get('/', function () {
    // return view('welcome');
    return redirect('admin/login');
});
