<?php

use Illuminate\Http\Request;

use App\Models\CommonName;
use App\Http\Resources\CertificateCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('certificates', 'UserCollection');

// Route::get('/certificates', function () {
//     return new CertificateCollection(CommonName::all());
// });

Route::get('/commonnames', function () {
    return new CertificateCollection(
        collect(app()->make('CertificateService')->get_commonname_list()->getIterator())
    );
});

Route::post('fileupload', function () {
    dd(request()->file->getClientOriginalName());
});