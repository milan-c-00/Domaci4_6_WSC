<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function() {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('users', UserController::class);
    });

    Route::middleware('role:regular_user')->group(function() {

        Route::get('people', [FriendController::class, 'others'])->name('people.others');
        Route::post('people/{user}/addFriend', [FriendController::class, 'addFriend'])->name('people.addFriend');
        Route::get('people/requests', [FriendController::class, 'friendRequests'])->name('people.friendRequests');

        Route::middleware('has_request')->group(function() {
            Route::delete('people/requests/{user}/remove', [FriendController::class, 'removeRequest'])->name('people.removeRequest');
            Route::post('people/requests/{user}/accept', [FriendController::class, 'acceptRequest'])->name('people.acceptRequest');
            Route::delete('people/requests/{user}/decline', [FriendController::class, 'declineRequest'])->name('people.declineRequest');
        });

        Route::get('people/friends', [FriendController::class, 'friends'])->name('people.friends');

        Route::middleware('is_friend')->group(function() {
            Route::delete('people/friends/{user}/remove', [FriendController::class, 'removeFriend'])->name('people.removeFriend');
            Route::get('people/friends/{user}/messages', [MessageController::class, 'messages'])->name('friend.messages');
            Route::post('people/friends/{user}/messages', [MessageController::class, 'sendMessage'])->name('friend.sendMessage');
            Route::delete('people/friends/{user}/messages', [MessageController::class, 'deleteConversation'])->name('friend.deleteConversation');
        });

    });


});

require __DIR__.'/auth.php';
