<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthManager;
use App\Http\Controllers\bookingManager;
use App\Http\Controllers\RoomManager;
use App\Http\Controllers\CreateRoomManager;
use App\Http\Controllers\UserManager;
use GuzzleHttp\Promise\Create;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/Login', [AuthManager::class, 'login'])->name('login')->middleware('redirectIfAuthenticated');
    Route::post('/Login', [AuthManager::class, 'loginPost'])->name('login.post');
    Route::get('/Signup', [AuthManager::class, 'register'])->name('register')->middleware('redirectIfAuthenticated');
    Route::post('/Signup', [AuthManager::class, 'registerPost'])->name('register.post');
    Route::get('/ForgotPassword', [AuthManager::class, 'forgotview'])->name('forgot')->middleware('redirectIfAuthenticated');
    Route::post('/Reset', [AuthManager::class, 'reset'])->name('reset');
});

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout')->middleware('logout');

Route::middleware(['auth', 'web', 'customer'])->group(function () {
    Route::get('/Customer', [UserManager::class, 'users'])->name('customer.index');
    Route::get('/Customer/Profile', [UserManager::class, 'profile'])->name('customer.profile');
    Route::post('/Customer/Profile/edit', [UserManager::class, 'editprofile'])->name('edit.customer');
    Route::get('/Customer/MyRooms', [bookingManager::class, 'myrooms'])->name('customer.rooms');
    Route::get('/Customer/MyRooms/check_out/{booking_id}', [bookingManager::class, 'checkout'])->name('checkout.room');
    Route::get('/RoomView/{room_id}', [RoomManager::class, 'roomview'])->name('view.room');
    Route::post('/RoomView/{room_id}', [bookingManager::class, 'bookroom'])->name('book.room');
    Route::delete('/Customer/RemoveAccount', [UserManager::class, 'removeAccount'])->name('customer.remove');
});

Route::middleware(['auth', 'web', 'owner'])->group(function () {
    Route::get('/Owner', [UserManager::class, 'users'])->name('owner.index');
    Route::get('/Owner/Profile', [UserManager::class, 'profile'])->name('owner.profile');
    Route::post('/Owner/Profile/edit', [UserManager::class, 'editprofile'])->name('edit.owner');
    Route::get('/RoomCreate', [CreateRoomManager::class, 'roomCreate'])->name('create.room');
    Route::post('/RoomCreate', [CreateRoomManager::class, 'Create'])->name('create');
    Route::get('/RoomEdit/{room_id}', [RoomManager::class, 'editroom'])->name('edit.room');
    Route::put('/RoomEdit/Update/{room_id}', [RoomManager::class, 'roomUpdate'])->name('update.room');
    Route::put('/RoomEdit/Addimg/{room_id}', [RoomManager::class, 'imgUpdate'])->name('upload.images');
    Route::put('/RoomEdit/Hide/{room_id}', [RoomManager::class, 'roomHide'])->name('hide.room');
    Route::delete('/RoomDelete/{room_id}', [RoomManager::class, 'deleteRoom'])->name('delete.room');
    Route::delete('/Owner/RemoveAccount', [UserManager::class, 'removeAccount'])->name('owner.remove');
});





