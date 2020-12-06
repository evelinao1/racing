<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BetterController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\RaceController;
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
    return view('home');
});

Route::group(['prefix'=>'race'],function(){
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/',[RaceController::class,'index'])->name('race.index');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create',[RaceController::class,'create'])->name('race.create');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store',[RaceController::class,'store'])->name('race.store');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{better}',[BetterController::class,'editbet'])->name('race.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{better}',[BetterController::class,'updatebet'])->name('race.updatebet');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/sort',[BetterController::class,'sort'])->name('race.sort');

    // Route::middleware(['auth:sanctum', 'verified'])->
    // post('/destroy/{menu}',[MenuController::class,'destroy'])->name('menu.destroy');
    
    // Route::middleware(['auth:sanctum', 'verified'])->
    // get('/print',[PdfController::class,'printMenu'])->name('menu.print');
});

Route::group(['prefix'=>'horse'],function(){
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/',[HorseController::class,'index'])->name('horse.index');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create',[HorseController::class,'create'])->name('horse.create');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store',[HorseController::class,'store'])->name('horse.store');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{horse}',[HorseController::class,'edit'])->name('horse.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{horse}',[HorseController::class,'update'])->name('horse.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/destroy/{horse}',[HorseController::class,'destroy'])->name('horse.destroy');
    
    // Route::middleware(['auth:sanctum', 'verified'])->
    // get('/print',[PdfController::class,'printMenu'])->name('menu.print');
});

Route::group(['prefix'=>'better'],function(){
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/',[BetterController::class,'index'])->name('better.index');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create',[BetterController::class,'create'])->name('better.create');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store',[BetterController::class,'store'])->name('better.store');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{better}',[BetterController::class,'edit'])->name('better.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{better}',[BetterController::class,'update'])->name('better.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/destroy/{better}',[BetterController::class,'destroy'])->name('better.destroy');
    
    // Route::middleware(['auth:sanctum', 'verified'])->
    // get('/print',[BetterController::class,'printMenu'])->name('menu.print');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
