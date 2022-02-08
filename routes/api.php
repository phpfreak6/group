<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Controllers */
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\GroupMessageController;

Route::group(['prefix' => 'groups'], function () {
    Route::post('/', [GroupController::class, 'create']);
    Route::post('add-participant', [GroupController::class, 'addGroupParticipant']);
    Route::post('remove-participant', [GroupController::class, 'removeGroupParticipant']);
    Route::get('message/{group_id}', [GroupMessageController::class, 'get']);
    Route::post('message', [GroupMessageController::class, 'create']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
