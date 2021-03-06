<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth','middleware'=>'api','namespace'=>'Auth'], function () {
    Route::post('register', 'RegisterController');
    Route::post('regenerate','RegenerateOtpController');
    Route::post('verification','VerificationController');
    Route::post('update-password','UpdatePasswordController');
    Route::post('login','LoginController');
    Route::post('logout','LogoutController')->middleware('auth:api');
    Route::post('check-token','CheckTokenController')->middleware('auth:api');

    Route::get('/social/{provider}','SocialiteController@redirectToProvider');
    Route::get('/social/{provider}/callback','SocialiteController@handleProviderCallback');
});

Route::group([
    'middleware' => ['api','email_verified','auth:api'],
   
], 
    function () {
    Route::get('profile/show', 'ProfileController@show');
    Route::post('profile/update', 'ProfileController@update');
});

Route::group([
    'middleware'=>'api',
    'prefix'=>'campaign'
],
    function(){
        Route::get('random/{count}','CampaignController@random');
        Route::post('store','CampaignController@store');
        Route::get('/','CampaignController@index');
        Route::get('/{id}','CampaignController@detail');
        Route::get('/search/{keyword}','CampaignController@search');
    }
);

Route::group([
    'middleware'=>'api',
    'prefix'=>'blog'
],
    function(){
        Route::get('random/{count}','BlogController@random');
        Route::post('store','BlogController@store');
    }
);
