<?php

use App\Models\Kambing;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('/login', function (Request $r) {
    $password = env('APP_LOGIN_PASSWORD');

    $passwordBody = json_decode($r->getContent())?->password;


    if ($passwordBody == $password) {
        $key = env('APP_KEY');
        $jwt = JWT::encode([], $key, 'HS256');

        return $jwt;
    } else {
        response('Password incorrect', 401);
    }
});

Route::get('/kambings', function (Request $r) {
    return Kambing::all();
});
Route::get('/kambings/{id}', function (Request $r, int $id) {
    return Kambing::query()->find($id);
});

Route::delete('/kambings/{id}', function (Request $r, int $id) {
    return Kambing::query()->where('id', '=', $id)->delete($id);
});

Route::post('/kambings', function (Request $r) {
    $v = json_decode($r->getContent());
    return response(
        Kambing::query()->updateOrCreate(['id' => isset($v->id) ? $v->id : null], (array) $v),
        200,
        ['content-type' => 'application/json']
    );
});
Route::get('/kambings/{id}/photo', function (Request $r, int $id) {
    return  response()->file(storage_path() . '/kambing_' . $id);
});

Route::post('/kambings', function (Request $r) {
    $v = json_decode($r->getContent());

    $k = Kambing::query()->updateOrCreate(['id' => isset($v->id) ? $v->id : null], (array) $v);


    // Check image
    if (isset($v->image)) {
        File::put(storage_path() . '/kambing_' . $k->id, base64_decode($v->image));
    }

    return  $k;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
