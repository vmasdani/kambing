<?php

use App\Models\Kambing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/kambings', function (Request $r) {
    return Kambing::all();
});
Route::post('/kambings', function (Request $r) {
    $v = json_decode($r->getContent());
    return  Kambing::query()->updateOrCreate(['id' => isset($v->id) ? $v->id : null], (array) $v);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
