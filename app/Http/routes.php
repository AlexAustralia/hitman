<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth'], function() {

        Route::get('/', function () {
            return view('app');
        });

        // Here is the section restricted for all users apart from Administrator
        Route::group(['middleware' => 'admin'], function () {

            // Tools section
            // Users module
            Route::get('tools/users', 'ToolsController@users');
            Route::get('tools/users/create', 'ToolsController@create_user');
            Route::post('tools/users/save', 'ToolsController@save_user');
            Route::get('tools/users/edit/{id}', 'ToolsController@edit_user');
            Route::get('tools/change-password', 'ToolsController@change_password');

            // Franchisee Settings module
            Route::get('tools/franchisee-settings', 'ToolsController@get_franchisee_settings');
            Route::post('tools/franchisee-settings', 'ToolsController@post_franchisee_settings');

            // Edit Lookups section
            // Suburbs module
            Route::get('edit-lookups/suburbs', 'EditLookupsController@suburbs');
            Route::post('edit-lookups/suburbs/save', 'EditLookupsController@ajax_save_suburbs');
            Route::post('edit-lookups/suburbs/delete', 'EditLookupsController@ajax_delete_suburbs');
        });
    });

    Route::auth();
});
