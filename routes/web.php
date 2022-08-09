<?php

use App\Http\Controllers\IngController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\Ajax\SelectController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Select2Dropdown;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/ingredients', IngController::class);
Route::resource('/recipes', RecipeController::class);
Route::resource('/cakes', CakeController::class);
Route::post('/storePrices', [CakeController::class, 'storePrices']);
Route::resource('/products', ProductController::class);
Route::post('/updateIngprice', [IngController::class, 'updateIngprice']);
Route::get('/getIngprice', [IngController::class, 'getIngprice']);
Route::get('select2_ajax', [CakeController::class,'select2_ajax']);
Route::get('ajax/ingredients', [SelectController::class, 'searchIngredients']);

require __DIR__.'/auth.php';
