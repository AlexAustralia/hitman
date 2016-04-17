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

            /*
             *  Tools section
             */

            // Users module
            Route::get('tools/users', 'ToolsController@users');
            Route::get('tools/users/create', 'ToolsController@create_user');
            Route::post('tools/users/save', 'ToolsController@save_user');
            Route::get('tools/users/edit/{id}', 'ToolsController@edit_user');
            Route::get('tools/change-password', 'ToolsController@change_password');

            // Franchisee Settings module
            Route::get('tools/franchisee-settings', 'ToolsController@get_franchisee_settings');
            Route::post('tools/franchisee-settings', 'ToolsController@post_franchisee_settings');

            /*
             *  Edit Lookups section
             */

            // Suburbs module
            Route::get('edit-lookups/suburbs', 'EditLookupsController@suburbs');
            Route::post('edit-lookups/suburbs/save', 'EditLookupsController@ajax_save_suburbs');
            Route::post('edit-lookups/suburbs/delete', 'EditLookupsController@ajax_delete_suburbs');

            // Streets module
            Route::get('edit-lookups/streets', 'EditLookupsController@streets');
            Route::post('edit-lookups/streets/upload', 'EditLookupsController@ajax_upload_streets');
            Route::post('edit-lookups/streets/save', 'EditLookupsController@ajax_save_streets');
            Route::post('edit-lookups/streets/delete', 'EditLookupsController@ajax_delete_streets');

            // Technician Types module
            Route::get('edit-lookups/technician-types', 'EditLookupsController@technician_types');
            Route::post('edit-lookups/technician-types/save', 'EditLookupsController@ajax_save_technician_types');
            Route::post('edit-lookups/technician-types/delete', 'EditLookupsController@ajax_delete_technician_types');

            // Licence Description module
            Route::get('edit-lookups/licence-description', 'EditLookupsController@licence_description');
            Route::post('edit-lookups/licence-description/save', 'EditLookupsController@ajax_save_licence_description');
            Route::post('edit-lookups/licence-description/delete', 'EditLookupsController@ajax_delete_licence_description');

            // Standard Jobs module
            Route::get('edit-lookups/standard-jobs', 'EditLookupsController@standard_jobs');
            Route::post('edit-lookups/standard-jobs/save', 'EditLookupsController@ajax_save_standard_jobs');
            Route::post('edit-lookups/standard-jobs/delete', 'EditLookupsController@ajax_delete_standard_jobs');

            // Standard Tasks module
            Route::get('edit-lookups/standard-tasks', 'EditLookupsController@standard_tasks');
            Route::post('edit-lookups/standard-tasks/save', 'EditLookupsController@ajax_save_standard_tasks');
            Route::post('edit-lookups/standard-tasks/delete', 'EditLookupsController@ajax_delete_standard_tasks');

            // Chemicals module
            Route::get('edit-lookups/chemicals', 'EditLookupsController@chemicals');
            Route::post('edit-lookups/chemicals/save', 'EditLookupsController@ajax_save_chemicals');
            Route::post('edit-lookups/chemicals/delete', 'EditLookupsController@ajax_delete_chemicals');

            // Titles module
            Route::get('edit-lookups/titles', 'EditLookupsController@titles');
            Route::post('edit-lookups/titles/save', 'EditLookupsController@ajax_save_titles');
            Route::post('edit-lookups/titles/delete', 'EditLookupsController@ajax_delete_titles');

            // Job Sources module
            Route::get('edit-lookups/job-sources', 'EditLookupsController@job_sources');
            Route::post('edit-lookups/job-sources/save', 'EditLookupsController@ajax_save_job_sources');
            Route::post('edit-lookups/job-sources/delete', 'EditLookupsController@ajax_delete_job_sources');

            // Sections module
            Route::get('edit-lookups/sections', 'EditLookupsController@sections');
            Route::post('edit-lookups/sections/save', 'EditLookupsController@ajax_save_sections');
            Route::post('edit-lookups/sections/delete', 'EditLookupsController@ajax_delete_sections');
        });
    });

    Route::auth();
});
