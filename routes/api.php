<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RouteController::class)
->group(function(){
    // Get
    Route::get('data/lists','dataList');
    Route::get('product/lists/{id}','productListId');
    Route::get('category/delete/{id}','categoryDelete');
    // Post
    Route::post('category/create','categoryCreate');
    Route::post('category/update','CategoryUpdate');

});

