<?php

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login','Auth\LoginController@loginPost');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/forgot-password','Auth\ForgotPasswordController@forgotPassword');
Route::post('/forgot-password','Auth\ForgotPasswordController@forgotPasswordPost');

Route::get('/reset-password/{token}','Auth\ResetPasswordController@resetPassword');
Route::post('/reset-password/{token}','Auth\ResetPasswordController@resetPasswordPost');