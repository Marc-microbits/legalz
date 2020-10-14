<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','InstallerController@index');
Route::get('/install','InstallerController@index');
Route::get('/install/requirements','InstallerController@requirements')->name('check.requirements');
Route::get('/install/db-information','InstallerController@install')->name('get.dBinfo');
Route::get('/install/run-installer','InstallerController@runInstaller')->name('run.installer');
Route::get('/install/success','InstallerController@successInstall')->name('install.success');
Route::post('/install/run-installer','InstallerController@runInstaller')->name('run.installer');
