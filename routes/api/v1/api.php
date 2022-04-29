<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V1'], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('register', 'UserAuthController@registration');
        Route::post('login', 'UserAuthController@login');
    });
  ;

    Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
        Route::get('info', 'UserController@info');
        Route::post('update-profile', 'UserController@update_profile');
        Route::post('cm-firebase-token', 'UserController@update_cm_firebase_token');
        Route::post("postjob","ApiController@postjob");
    });



    // test api
    // Route::group(['prefix'=>'data','middleware'=>'auth:api'],function(){
        Route::any("postjob","API\ApiController@postjob");
        // save tokens
        // Route::any("savetoken","API\ApiController@savetoken");
        // addding reviews for developer
        Route::any("addreview","API\ApiController@postreview");
        // forgot password
        Route::any("forgotpassword","API\ApiController@forgotpassword");
        // get list of category
        Route::any("listofcategory","ApiController@listofcategory");
        
        // listing jobs
        Route::any("listofjobs","ApiController@getlistofjobs");
        
        // listing jobs by category
        Route::any("listofjobsbycategory","ApiController@listofjobsbycategory");
        
        // get previous job posts by user
        Route::any("getuserpastjobsposts","ApiController@getuserpastjobsposts");
        // getting token data
        // Route::any("gettoken","API\ApiController@gettokendata");
        // chat media upload
        Route::any("chatuploadmedia","API\ApiController@chatuploadmedia");
        // editing user profile
        route::any("editprofile","API\ApiController@editprofile");
        // top developer
        Route::any("topdeveloper","API\ApiController@topdeveloper");
        // get developerbycategoryid
        Route::any("getdeveloperbycatid","API\ApiController@getdeveloperbycatid");
        // search for developer
        Route::any("searchterm","API\ApiController@searchjob");
        // contact us
        Route::any("contactus","API\ApiController@contactus");
        // developer details
        Route::any("developerdetails","API\ApiController@developerdetails");
        // review list
        Route::any("reviewlistbydeveloper","API\ApiController@reviewlistbydeveloper");
        // get all categories
        Route::any("getcategory","ApiController@getcategory");
        // media file upload
        Route::post("mediaupload",[ApiController::class,"mediaupload"]);
        // deleting media files
        Route::get("deletemedia",[ApiController::class,"deletemedia"]);  
        
    });
    
   
// });
