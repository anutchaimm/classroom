<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckAge;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {

    Route::get('/control', 'ControlController@index')->name('control');

    Route::post('/control', 'ControlController@store')->name('control.store');

    Route::post('/control/create', 'ControlController@create')->name('control.create');

    Route::get('/profile/{id}', 'ProfileController@index')->name('profile.show');

    Route::patch('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

    Route::get('/room/{id}', 'ClassroomController@show', function ($id) {
        //
    })->middleware(CheckAge::class)->name('classroom.show');

    Route::put('/classroom/update/{id}', 'ClassroomController@update')->name('classroom.update');

    Route::put('/content/insert/{id}', 'ContentController@update')->name('content.update');

    Route::get('/content/delete/{id}', 'ContentController@destroy')->name('content.destroy');

    Route::post('/content/edit', 'ContentController@edit')->name('content.edit');

    Route::get('/content/show/{id}', 'ContentController@show')->name('content.show');

    Route::post('/comment', 'CommentController@store')->name('comment.store');

    Route::get('/comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('/room/schedule/{id}', 'ScheduleController@show')->name('schedule.show');

    Route::post('/schedule/store/{id}', 'ScheduleController@store')->name('schedule.store');

    Route::post('/schedule/edit', 'ScheduleController@edit')->name('schedule.edit');

    Route::put('/schedule/create/{id}', 'ScheduleController@create')->name('schedule.create');

    Route::get('/schedule/deletemember/{id}', 'ScheduleController@destroymember')->name('schedule.destroymember');

    Route::get('/schedule/deletedivision/{id}', 'ScheduleController@destroydivision')->name('schedule.destroydivision');

    Route::get('/match/{id}', 'ScheduleController@index')->name('match.show');

    Route::get('/match/round/{id}', 'ScheduleController@createround')->name('match.createround');

    Route::post('/match/update', 'ScheduleController@update')->name('match.update');

    Route::get('/point/increment/{id}', 'ScheduleController@incrementpoint')->name('match.incrementpoint');

    Route::get('/point/decrement/{id}', 'ScheduleController@decrementpoint')->name('match.decrementpoint');

    Route::get('/leaderboard/{id}', 'LeaderBoardController@show')->name('leaderboard.show');

    Route::get('/paring/{id}', 'PairingController@show')->name('pairing.show');

    Route::post('/paring/request', 'PairingController@edit')->name('pairing.edit');

    Route::post('/classroomuser/delete', 'ClassroomUserController@destroy')->name('classroomuser.destroy');

    Route::get('/chat', 'ChatController@index')->name('chat');

    Route::get('/message/{id}', 'ChatController@getMessage')->name('chat.message');

    Route::post('message', 'ChatController@sendMessage');

    Route::post('/pretest/{id}', 'ClassroomPretestController@csv_import')->name('pretest.import');

    Route::post('/pretest/export/{id}', 'ClassroomPretestController@csv_export')->name('pretest.export');

    Route::get('/pretest/show/{id}', 'ClassroomPretestController@show')->name('pretest.show');

    Route::get('/exam/show/{id}', 'ClassroomPretestExamController@show')->name('exam.show');

    Route::post('/exam/update/{id}', 'ClassroomPretestExamController@update')->name('exam.update');

    Route::post('/generate/{id}', 'ScheduleController@generate')->name('match.generate');

    Route::get('/test', function () {
        return view('backend.test');
    })->name('test');

});



// Route::middleware(['auth'])->group(function () {

//     Route::get('/control', 'ControlController@index')->name('control');

//     Route::post('/control', 'ControlController@store')->name('control.store');

//     Route::post('/control/create', 'ControlController@create')->name('control.create');

//     Route::get('/profile/{id}', 'ProfileController@index')->name('profile.show');

//     Route::patch('/profile/update/{id}', 'ProfileController@update')->name('profile.update');

//     Route::get('/room/{id}', 'ClassroomController@show', function ($id) {
//         //
//     })->middleware(CheckAge::class)->name('classroom.show');

//     Route::put('/classroom/update/{id}', 'ClassroomController@update')->name('classroom.update');

//     Route::put('/content/insert/{id}', 'ContentController@update')->name('content.update');

//     Route::get('/content/delete/{id}', 'ContentController@destroy')->name('content.destroy');

//     Route::post('/content/edit', 'ContentController@edit')->name('content.edit');

//     Route::get('/content/show/{id}', 'ContentController@show')->name('content.show');

//     Route::post('/comment', 'CommentController@store')->name('comment.store');

//     Route::get('/comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');

//     Route::get('/room/schedule/{id}', 'ScheduleController@show')->name('schedule.show');

//     Route::post('/schedule/store/{id}', 'ScheduleController@store')->name('schedule.store');

//     Route::post('/schedule/edit', 'ScheduleController@edit')->name('schedule.edit');

//     Route::put('/schedule/create/{id}', 'ScheduleController@create')->name('schedule.create');

//     Route::get('/schedule/deletemember/{id}', 'ScheduleController@destroymember')->name('schedule.destroymember');

//     Route::get('/schedule/deletedivision/{id}', 'ScheduleController@destroydivision')->name('schedule.destroydivision');

//     Route::get('/match/{id}', 'ScheduleController@index')->name('match.show');

//     Route::get('/match/round/{id}', 'ScheduleController@createround')->name('match.createround');

//     Route::post('/match/update', 'ScheduleController@update')->name('match.update');

//     Route::get('/point/increment/{id}', 'ScheduleController@incrementpoint')->name('match.incrementpoint');

//     Route::get('/point/decrement/{id}', 'ScheduleController@decrementpoint')->name('match.decrementpoint');

//     Route::get('/leaderboard/{id}', 'LeaderBoardController@show')->name('leaderboard.show');

//     Route::get('/paring/{id}', 'PairingController@show')->name('pairing.show');

//     Route::post('/paring/request', 'PairingController@edit')->name('pairing.edit');

//     Route::post('/classroomuser/delete', 'ClassroomUserController@destroy')->name('classroomuser.destroy');

//     Route::get('/chat', 'ChatController@index')->name('chat');

//     Route::get('/message/{id}', 'ChatController@getMessage')->name('chat.message');

//     Route::post('message', 'ChatController@sendMessage');

//     Route::post('/paring/unfriend', 'PairingController@update')->name('pairing.update');

//     Route::post('/pretest/{id}', 'ClassroomPretestController@csv_import')->name('pretest.import');

//     Route::post('/pretest/export/{id}', 'ClassroomPretestController@csv_export')->name('pretest.export');

//     Route::get('/pretest/show/{id}', 'ClassroomPretestController@show')->name('pretest.show');

//     Route::get('/exam/show/{id}', 'ClassroomPretestExamController@show')->name('exam.show');

//     Route::post('/exam/update/{id}', 'ClassroomPretestExamController@update')->name('exam.update');

//     Route::post('/generate/{id}', 'ScheduleController@generate')->name('match.generate');

//     Route::post('/schedule/search/{id}', 'ScheduleController@search')->name('schedule.search');

//     Route::get('/test', function () {
//         return view('backend.pretest');
//     })->name('test');

// });
