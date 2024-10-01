<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

// Ejercicio 1

Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});
Route::post('/ejercicio2/a', function (Request $request) {
    return response()->json([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price')
    ]);
});
Route::post('/ejercicio2/b', function (Request $request) {
    if ($request -> input('price') < 0) {
        return response()->json(["message" => "Price can't be less than 0"], 422);
    }
    return response()->json([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $request->input('price')
    ]);
});

Route::post('/ejercicio2/c', function (Request $request) {
    $price = $request->input('price');
    $discount = $request->input('discount');

    if ($discount == "SAVE5") {
        $price = $price * 0.95;
    } else if ($discount == "SAVE10") {
        $price = $price * 0.9;
    } else if ($discount == "SAVE15") {
        $price = $price * 0.85;
    } else {
        return response()->json(["message" => "Invalid discount code"], 422);
    }

    return response()->json([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'price' => $price,
        'discount' => $discount
    ]);
});
