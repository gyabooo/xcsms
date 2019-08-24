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

// Route::get('/commonnames', function () {
//     return new CertificateCollection(
//         collect(app()->make('CertificateService')->get_commonname_list()->getIterator())
//     );
// });

// Route::post('/certificates/check_upload_file', function (Request $request) {

//     $file = $request->file('file');
//     // foreach ($request->file('files') as $index => $file) {
//     $file_name = $file->getClientOriginalName();
//     $file_extention = $file->getClientOriginalExtension();
//     $search_extentions = ['crt', 'pem', 'key'];
//     $checked_file = array(
//         'type' => $file_extention,
//         'filename' => $file_name,
//     );

//     if(!array_search($file_extention, $search_extentions)) {
//         $checked_file['type'] = 'none';
//     }
//     else {
//         $checked_file['type'] = $file_extention;
//     }

//     // }
//     return $checked_file;
// });

Route::get('/commonnames', function () {
    return new CertificateCollection(
        collect(app()->make('CertificateService')->get_commonname_list()->getIterator())
    );
});

Route::Resource('commonnames', 'Api\CommonnamesController')->only([
    'store'
]);

Route::Resource('commonnames.certificates', 'Api\CertificatesController')->only([
    'store', 'update'
]);