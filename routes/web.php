<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PetitionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::post('/profile/name', 'ProfileController@updateName');
Route::post('/profile/email', 'ProfileController@updateEmail');
Route::post('/profile/password', 'ProfileController@updatePassword');
Route::post(
    '/profile/passwordchangebyadmin',
    'ProfileController@updatePasswordByAdmin'
);

Route::get('/petitions/all', 'PetitionController@allpetition');
Route::resource('/petitions/sign', 'SignatureController');
Route::resource('/petitions/update', 'UpdatesController');
Route::resource('/petitions', 'PetitionController');
Route::resource('/admin', 'AdminController');
Route::resource('/users', 'UsersController');
// Route::fallback(function () {
//     return view('pages.error');
// });
