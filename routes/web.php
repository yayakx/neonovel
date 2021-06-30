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

Route::get('/', 'c_rss@main')->name('main');
Route::get('/tes', 'c_rss@tes')->name('tes');
Route::post('/carinovel', 'c_rss@carinovel')->name('carinovel');
Route::post('/carift', 'c_rss@carift')->name('carift');
Route::get('/daftarft', 'c_rss@daftarft')->name('daftarft');
Route::get('/tambahft', 'c_rss@tambahft')->name('tambahft');
Route::post('/addft', 'c_rss@addft')->name('addft');
