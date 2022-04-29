<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit')->middleware('activation');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
        Route::get('settings', 'SystemController@settings')->name('settings');
        Route::post('settings', 'SystemController@settings_update');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
        // category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('add', 'CategoryController@index')->name('add');
            Route::post('store', 'CategoryController@store')->name('store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('update/{id}', 'CategoryController@update')->name('update');
            Route::get('status/{id}/{status}', 'CategoryController@status')->name('status');
            Route::delete('delete/{id}', 'CategoryController@delete')->name('delete');
            Route::post('search', 'CategoryController@search')->name('search');
        });
        // jobs
        Route::group(['prefix' => 'job', 'as' => 'job.'], function () {
            Route::get('add-new', 'JobController@index')->name('add-new');
            Route::post('store', 'JobController@store')->name('store');
            Route::get('edit/{id}', 'JobController@edit')->name('edit');
            Route::post('update/{id}', 'JobController@update')->name('update');
            Route::get('list', 'JobController@list')->name('list');
            Route::delete('delete/{id}', 'JobController@delete')->name('delete');
            Route::get('status/{id}/{status}', 'JobController@status')->name('status');
            Route::post('search', 'JobController@search')->name('search');

            Route::get('view/{id}', 'JobController@view')->name('view');
            Route::get('remove-image/{id}/{name}', 'JobController@remove_image')->name('remove-image');

        });

        // notifications
        Route::group(['prefix' => 'notification', 'as' => 'notification.'], function () {
            Route::get('add-new', 'NotificationController@index')->name('add-new');
            Route::post('store', 'NotificationController@store')->name('store');
            Route::get('edit/{id}', 'NotificationController@edit')->name('edit');
            Route::post('update/{id}', 'NotificationController@update')->name('update');
            Route::get('status/{id}/{status}', 'NotificationController@status')->name('status');
            Route::delete('delete/{id}', 'NotificationController@delete')->name('delete');
        });
        // languages
        Route::group(['prefix' => 'language', 'as' => 'language.'], function () {
            Route::get('add', 'LanguageController@index')->name('add');
            Route::post('store', 'LanguageController@store')->name('store');
            Route::get('edit/{id}', 'LanguageController@edit')->name('edit');
            Route::post('update/{id}', 'LanguageController@update')->name('update');
            Route::delete('delete/{id}', 'LanguageController@delete')->name('delete');
            Route::post('search', 'LanguageController@search')->name('search');
        });


        //  admin settings
        Route::group(['prefix' => 'admin-settings', 'as' => 'admin-settings.'], function () {
            Route::get('system-setup', 'AdminSettingsController@system_index')->name('system-setup')->middleware('activation');
            Route::get('fcm-index', 'AdminSettingsController@fcm_index')->name('fcm-index')->middleware('activation');
            Route::post('update-fcm', 'AdminSettingsController@update_fcm')->name('update-fcm');

            Route::post('update-fcm-messages', 'AdminSettingsController@update_fcm_messages')->name('update-fcm-messages');

            Route::get('mail-config', 'AdminSettingsController@mail_index')->name('mail-config')->middleware('activation');
            Route::post('mail-config', 'AdminSettingsController@mail_config');
            
            Route::get('terms-and-conditions', 'AdminSettingsController@terms_and_conditions')->name('terms-and-conditions');
            Route::post('terms-and-conditions', 'AdminSettingsController@terms_and_conditions_update');
            Route::get('about-us', 'AdminSettingsController@about_us')->name('about-us');
            Route::post('about-us', 'AdminSettingsController@about_us_update');
        });


        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('list', 'UserController@user_list')->name('list');
            Route::post('search', 'UserController@search')->name('search');
        });
    });
});
