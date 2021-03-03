<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
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
Route::middleware(['auth', 'verified'])->group(function () {
    //Main routes
    Route::get('/', function() { return redirect('/home'); });
    Route::get('/home', [HomeController::class, 'receivedMessages'])->name('home');
    Route::get('/sentmessages', [HomeController::class, 'writtenMessages'])->name('sentmessages');
    Route::get('/contact', [UserController::class, 'confirmedContacts'])->name('confirmedcontacts');
    Route::get('/contactrequests', [UserController::class, 'contactRequests'])->name('contactrequests');

    //User routes
    Route::post('/user', [UserController::class, 'findByEmail'])->name('user.findbyemail');
    Route::post('/user/addContact', [UserController::class, 'addContact'])->name('user.addcontact');
    Route::post('/user/deleteContact', [UserController::class, 'deleteContact'])->name('user.deletecontact');
    Route::post('/user/requestContact', [UserController::class, 'requestContact'])->name('user.requestcontact');
    Route::post('/user/deleteRequest', [UserController::class, 'deleteRequest'])->name('user.deleterequest');
    Route::post('/user/reportUser', [UserController::class, 'reportUser'])->name('user.reportuser');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::resource('user', UserController::class, ['except' => ['store', 'create', 'index', 'edit']]);

    //Message routes
    Route::post('/message', [MessageController::class, 'store'])->name('message.store');
    Route::get('/message/{message}', [MessageController::class, 'show'])->name('message.show');

    //Admin routes
    Route::post('/user/blockUser', [UserController::class, 'blockUser'])->name('user.blockuser')->middleware(['admin']);
    Route::get('/admin', [UserController::class, 'adminView'])->name('admin')->middleware(['admin']);
});

//Auth and Verify routes
Auth::routes(['verify' => true]);


