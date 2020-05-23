<?php

Route::get('/'.config('faqs.faqs_slug', 'faqs').'/group/{slug}', ['uses' => 'FaqsController@group', 'as' => 'faqs']);
Route::get('/'.config('faqs.faqs_slug', 'faqs'), ['uses' => 'FaqsController@index', 'as' => 'faqs']);
Route::get('/'.config('faqs.faqs_slug', 'faqs').'/search', ['uses' => 'FaqsController@search', 'as' => 'faqs']);

