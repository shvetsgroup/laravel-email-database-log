<?php

Route::group([
    'prefix' => config('email_log.routes_prefix', ''),
    'middleware' => array_filter(['web',config('email_log.access_middleware', null)]),
], function(){
    Route::get('/email-log', ['as' => 'email-log', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@index']);
    Route::post('/email-log/delete', ['as' => 'email-log.delete-old', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@deleteOldEmails']);
    Route::get('/email-log/{id}/attachment/{attachment}', ['as' => 'email-log.fetch-attachment', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@fetchAttachment']);
    Route::get('/email-log/{id}', ['as' => 'email-log.show', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@show']);
});

Route::group([
    'prefix' => config('email_log.routes_prefix', ''),
], function(){
    //webhooks events
    Route::post('/email-log/webhooks/event', ['as' => 'email-log.webhooks', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@createEvent']);
});