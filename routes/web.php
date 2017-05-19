<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['middleware' => 'cors'], function() use ($app) {
  $app->group(['prefix' => 'api/v1'], function() use ($app) {
    //Meeting related routes
    $app->GET('meeting', [
      'uses' => 'MeetingController@index'
    ]);
    $app->GET('meeting/{id}', [
      'uses' => 'MeetingController@show'
    ]);
    $app->group(['middleware' => 'auth'], function() use($app){
      $app->POST('meeting', [
        'uses' => 'MeetingController@store'
      ]);
      $app->PATCH('meeting/{id}', [
      'uses' => 'MeetingController@update'
      ]);
      $app->DELETE('meeting/{id}', [
        'uses' => 'MeetingController@destroy'
      ]);
      //Registration in meeting related routes
      $app->POST('meeting/registration', [
        'uses' => 'RegistrationController@store'
      ]);
      $app->DELETE('meeting/registration/{id}', [
        'uses' =>'RegistrationController@destroy'
      ]);
    });
    //User authentication related routes
    $app->POST('user', [
      'uses' => 'AuthController@store'
    ]);
    $app->POST('user/signin', [
      'uses' => 'AuthController@signin'
    ]);
  });
});
