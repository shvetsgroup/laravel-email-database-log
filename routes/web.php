<?php

Route::group([
    'prefix' => config('email_log.routes_prefix', ''),
    'middleware' => config('email_log.access_middleware', null)
], function(){
    Route::get('/email-log', ['as' => 'email-log', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@index']);
    Route::get('/email-log/fetch-attachment', ['as' => 'email-log.fetch-attachment', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@fetchAttachment']);
    Route::get('/email-log/{id}', ['as' => 'email-log.show', 'uses' => 'Dmcbrn\LaravelEmailDatabaseLog\EmailLogController@show']);
});