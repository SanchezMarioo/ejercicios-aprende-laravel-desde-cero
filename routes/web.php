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
    $name = $request->input('name');
    $description = $request->input('description');
    $price = $request->input('price');
    return Response::json([
        'name' => $name,
        'description' => $description,
        'price' => $price
    ]);
});
Route::post('/ejercicio2/b', function (Request $request) {
    $name = $request->input('name');
    $description = $request->input('description');
    $price = $request->input('price');
    if ($price < 0) {
        return Response::json([
            'message' => "Price can't be less than 0"
        ], 422);
    } else {
        return Response::json([
            'name' => $name,
            'description' => $description,
            'price' => $price
        ]);
    }
});
Route::post('/ejercicio2/c', function (Request $request) {
    $name = $request->input('name');
    $description = $request->input('description');
    $price = $request->input('price');
    $discountCode = $request->query('discount');
    $discount = 0;
    if ($discountCode == "SAVE5") {
        $discount = 5;
    } elseif ($discountCode == "SAVE10") {
        $discount = 10;
    } elseif ($discountCode == "SAVE15") {
        $discount = 15;
    }
    $price = $price - ($price * $discount / 100);
    return Response::json([
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'discount' => $discount
    ]);
});
