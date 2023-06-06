<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Indexcontroller;
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

//protected
Route::get('/data',[Indexcontroller::class,'index'])->middleware('guard');

Route::get('/group',[Indexcontroller::class,'group'])->middleware('guard');

//middleware
Route::get('/login',function(){
    session()->put('user_id',1);
    return redirect('/');
    // echo "Logged in";
    // echo "<pre>";
    // print_r(session()->all());
    // die;
});

Route::get('/logout',function(){
    session()->forget('user_id');
    return redirect('/');
});

Route::get('/no-access',function(){
    echo "you're not to allowed access the page";
    die;
});
