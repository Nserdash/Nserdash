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


require __DIR__.'/auth.php';


Route::group([
    'middleware' => 'auth',
  ], function () {

Route::get('/', function () {

  return redirect()->route('news.all');

});

Route::get('/Like/{idnews}/{userid}', '\App\Http\Controllers\LikesController@Like')->name('likes'); //Лайки

Route::get('/Музыка', '\App\Http\Controllers\MusicController@allData')->name('music'); //Вся музыка

Route::post('/submit/music', '\App\Http\Controllers\MusicController@publicate')->name('post.audio'); //Опубликовать музыку

Route::get('/Mузыка/{cat}/{name}', '\App\Http\Controllers\MusicController@category')->name('music.cat'); //Категории вывод

Route::post('/submit', '\App\Http\Controllers\NewsController@submit')->name('send.news'); // Опубликовать Новость

Route::post('/submit/com', '\App\Http\Controllers\CommentsController@comsubmit')->name('comment.news'); // Опубликовать Новость Коммент

Route::get('/Новости', '\App\Http\Controllers\NewsController@allData')->name('news.all');// Новости

Route::get('/delete/{id}', '\App\Http\Controllers\NewsController@destroy')->name('news.delete'); // Удалить новость

Route::get('/deletecom/{id}', '\App\Http\Controllers\NewsController@destroycomment')->name('comment.delete'); // Удалить коммент

Route::get('/help', function () {
  return view('help');
})->name('help');

Route::get('/Все чаты', '\App\Http\Controllers\ChatController@allRooms')->name('chat'); //Чаты

Route::post('/sumbitchat', '\App\Http\Controllers\ChatController@RoomStart')->name('send.message'); //Комната создание

Route::get('/Чат/{user_id}/{counter_member}/{room_id}/{img}', '\App\Http\Controllers\ChatController@Room')->name('room'); //Комната

Route::get('/Фанаты', '\App\Http\Controllers\UsersController@allData')->name('users'); //Вся пользователи

Route::get('Пользователи/{id}/{name}', '\App\Http\Controllers\UsersController@profile')->name('profile'); //Профиль

Route::post('user', '\App\Http\Controllers\UsersController@red')->name('profile.red'); //Профиль

Route::post('userdesc', '\App\Http\Controllers\UsersController@desc')->name('desc.red'); //О себе

Route::post('userava', '\App\Http\Controllers\UsersController@ava')->name('ava.red'); //Аватар

});