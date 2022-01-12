<?php

namespace App\Http\Controllers;
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

//llama a form
Route::get('/',[CodeaController::class , 'index' ] );
// guardar
Route::post('codeaguardar',[CodeaController::class , 'codeaguardar' ] );
Route::post('update',[CodeaController::class , 'update' ] );
