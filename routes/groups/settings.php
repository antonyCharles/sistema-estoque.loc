<?php 
Route::get('/system','SystemController@detail')->middleware('role:'.trans('roles.systemRead'));
Route::get('/system/update','SystemController@update')->middleware('role:'.trans('roles.systemUpdate'));
Route::post('/system/update','SystemController@updatePost')->middleware('role:'.trans('roles.systemUpdate'));

Route::get('/system-role/update','RoleController@update')->middleware('role:'.trans('roles.roleRead'));
Route::post('/system-role/update','RoleController@updatePost')->middleware('role:'.trans('roles.roleUpdate'));

/*
Route::get('/language','LanguageController@list')->middleware('role:'.trans('roles.languageRead'));
Route::get('/language/create','LanguageController@create')->middleware('role:'.trans('roles.languageCreate'));
Route::post('/language/create','LanguageController@createPost')->middleware('role:'.trans('roles.languageCreate'));
Route::get('/language/{id}/update','LanguageController@update')->middleware('role:'.trans('roles.languageUpdate'));
Route::post('/language/{id}/update','LanguageController@updatePost')->middleware('role:'.trans('roles.languageUpdate'));
Route::get('/language/{id}/delete','LanguageController@delete')->middleware('role:'.trans('roles.languageDelete'));
Route::delete('/language/{id}/delete','LanguageController@deletePost')->middleware('role:'.trans('roles.languageDelete'));
*/

Route::get('/profile','ProfileController@list')->middleware('role:'.trans('roles.profileRead'));
Route::get('/profile/create','ProfileController@create')->middleware('role:'.trans('roles.profileCreate'));
Route::post('/profile/create','ProfileController@createPost')->middleware('role:'.trans('roles.profileCreate'));
Route::get('/profile/{id}/update','ProfileController@update')->middleware('role:'.trans('roles.profileUpdate'));
Route::post('/profile/{id}/update','ProfileController@updatePost')->middleware('role:'.trans('roles.profileUpdate'));
Route::get('/profile/{id}/delete','ProfileController@delete')->middleware('role:'.trans('roles.profileDelete'));
Route::delete('/profile/{id}/delete','ProfileController@deletePost')->middleware('role:'.trans('roles.profileDelete'));

Route::get('/role-profile/{id}/update', 'RoleProfileController@update')->middleware('role:'.trans('roles.roleProfileRead'));
Route::post('/role-profile/{id}/update', 'RoleProfileController@updatePost')->middleware('role:'.trans('roles.roleProfileUpdate'));

Route::get('/parameter-profile/{id}/update', 'ParameterProfileController@update')->middleware('role:'.trans('roles.parameterProfileRead'));
Route::post('/parameter-profile/{id}/update', 'ParameterProfileController@updatePost')->middleware('role:'.trans('roles.parameterProfileUpdate'));

Route::get('/group-parameter','GroupParameterController@list')->middleware('role:'.trans('roles.groupParameterRead'));
Route::get('/group-parameter/create','GroupParameterController@create')->middleware('role:'.trans('roles.groupParameterCreate'));
Route::post('/group-parameter/create','GroupParameterController@createPost')->middleware('role:'.trans('roles.groupParameterCreate'));
Route::get('/group-parameter/{id}/update','GroupParameterController@update')->middleware('role:'.trans('roles.groupParameterUpdate'));
Route::post('/group-parameter/{id}/update','GroupParameterController@updatePost')->middleware('role:'.trans('roles.groupParameterUpdate'));
Route::get('/group-parameter/{id}/delete','GroupParameterController@delete')->middleware('role:'.trans('roles.groupParameterDelete'));
Route::delete('/group-parameter/{id}/delete','GroupParameterController@deletePost')->middleware('role:'.trans('roles.groupParameterDelete'));

Route::get('/parameter','ParameterController@list')->middleware('role:'.trans('roles.parameterRead'));
Route::get('/parameter/create','ParameterController@create')->middleware('role:'.trans('roles.parameterCreate'));
Route::post('/parameter/create','ParameterController@createPost')->middleware('role:'.trans('roles.parameterCreate'));
Route::get('/parameter/{id}/update','ParameterController@update')->middleware('role:'.trans('roles.parameterUpdate'));
Route::post('/parameter/{id}/update','ParameterController@updatePost')->middleware('role:'.trans('roles.parameterUpdate'));
Route::get('/parameter/{id}/delete','ParameterController@delete')->middleware('role:'.trans('roles.parameterDelete'));
Route::delete('/parameter/{id}/delete','ParameterController@deletePost')->middleware('role:'.trans('roles.parameterDelete'));

Route::get('/user','UserController@list')->middleware('role:'.trans('roles.userRead'));
Route::get('/user/create','UserController@create')->middleware('role:'.trans('roles.userCreate'));
Route::post('/user/create','UserController@createPost')->middleware('role:'.trans('roles.userCreate'));
Route::get('/user/{id}/update','UserController@update')->middleware('role:'.trans('roles.userUpdate'));
Route::post('/user/{id}/update','UserController@updatePost')->middleware('role:'.trans('roles.userUpdate'));
Route::get('/user/{id}/delete','UserController@delete')->middleware('role:'.trans('roles.userDelete'));
Route::delete('/user/{id}/delete','UserController@deletePost')->middleware('role:'.trans('roles.userDelete'));

Route::get('/role-action/create','RoleActionController@create')->middleware('role:'.trans('roles.roleActionCreate'));
Route::post('/role-action/create','RoleActionController@createPost')->middleware('role:'.trans('roles.roleActionCreate'));
Route::get('/role-action/{id}/update','RoleActionController@update')->middleware('role:'.trans('roles.roleActionUpdate'));
Route::post('/role-action/{id}/update','RoleActionController@updatePost')->middleware('role:'.trans('roles.roleActionUpdate'));
Route::get('/role-action/{id}/delete','RoleActionController@delete')->middleware('role:'.trans('roles.roleActionDelete'));
Route::delete('/role-action/{id}/delete','RoleActionController@deletePost')->middleware('role:'.trans('roles.roleActionDelete'));

Route::get('/role-action-item/{id}/update','RoleActionItemController@update')->middleware('role:'.trans('roles.roleActionItemRead'));
Route::post('/role-action-item/{id}/update','RoleActionItemController@updatePost')->middleware('role:'.trans('roles.roleActionItemUpdate'));
