<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function(){

    Route::group(['namespace' => 'API\admin'], function(){
        Route::get('/pengaturan', 'PengaturanController@index');
        Route::post('/pengaturan', 'PengaturanController@store');

        Route::post('/produk/ubah/{id}', 'ProdukController@update');

        Route::resources([
            '/halaman' => 'HalamanController',
            '/produk' => 'ProdukController',
            '/galeri' => 'GaleriController',
        ]);
    });
});

Route::group(['prefix' => 'front'], function(){

    Route::group(['namespace' => 'API\front'], function(){
        Route::get('/halaman/{slug}', 'HalamanController@getHalaman');
        Route::get('/produk', 'ProdukController@index');
        Route::get('/galeri', 'GaleriController@getGaleri');
        // Route::get('/principals', 'HalamanController@getPrincipals');
    });

});
