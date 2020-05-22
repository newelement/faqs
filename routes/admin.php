<?php

Route::get('/faqs', ['uses' => 'AdminController@index', 'as' => 'faqs']);
Route::get('/faqs/create', ['uses' => 'AdminController@show', 'as' => 'faqs']);
Route::get('/faqs/{faq}', ['uses' => 'AdminController@get', 'as' => 'faqs']);
Route::post('/faqs', ['uses' => 'AdminController@create', 'as' => 'faqs']);
Route::put('/faqs/{faq}', ['uses' => 'AdminController@update', 'as' => 'faqs']);
Route::delete('/faqs/{faq}', ['uses' => 'AdminController@delete', 'as' => 'faqs']);

Route::get('/faq-group', ['uses' => 'AdminController@indexGroup', 'as' => 'faqs']);
Route::get('/faq-group/create', ['uses' => 'AdminController@showGroup', 'as' => 'faqs']);
Route::get('/faq-group/{faq}', ['uses' => 'AdminController@getGroup', 'as' => 'faqs']);
Route::post('/faq-group', ['uses' => 'AdminController@createGroup', 'as' => 'faqs']);
Route::put('/faq-group/{faq}', ['uses' => 'AdminController@updateGroup', 'as' => 'faqs']);
Route::delete('/faq-group/{faq}', ['uses' => 'AdminController@deleteGroup', 'as' => 'faqs']);

Route::put('/faq-settings', ['uses' => 'AdminController@updateSettings', 'as' => 'faqs']);
