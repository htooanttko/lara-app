<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockChatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FindFriendController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\OnlineStatusController;
use App\Http\Controllers\SaveChatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class, 'loginPage'])->name('user#loginPage');
Route::get('/home',[AuthController::class, 'loginPage'])->name('user#loginPage');

Route::get('login/page', [AuthController::class, 'loginPage'])->name('user#loginPage');
Route::get('register/page', [AuthController::class, 'registerPage'])->name('user#registerPage');

// status
Route::get('/status/online', [UserController::class, 'online'])->name('online');
Route::get('/status/offline', [UserController::class, 'offline'])->name('offline');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // profile
    // account
    Route::get('account', [UserController::class, 'accountPage'])->name('profile#accountPage');
    Route::post('account/update', [UserController::class, 'accountUpdate'])->name('profile#accountUpdate');
    Route::post('account/delete', [UserController::class, 'accountDelete'])->name('profile#accountDelete');
    Route::post('account/image/update', [UserController::class, 'accountImage'])->name('profile#accountImage');
    Route::get('account/password/change/page', [UserController::class, 'passwordChangePage'])->name('profile#accountPasswordChangePage');
    Route::post('account/password/change', [UserController::class, 'passwordChange'])->name('profile#accountPasswordChange');

    // contact add
    Route::post('contact/search', [ContactController::class, 'searchContact']);
    Route::post('contact/add', [ContactController::class, 'addContact'])->name('contact#addContact');
    Route::get('contact/add/{id}', [ContactController::class, 'addContactByid'])->name('contact#addContactByid');
    Route::get('contact/delete/{id}', [ContactController::class, 'deleteContact'])->name('contact#deleteContact');

    // chat
    Route::get('chat/{id}', [ChatController::class, 'chatPage'])->name('chat#chatPage');
    Route::get('chat/ajax/{id}', [ChatController::class, 'chatAjax']);
    Route::get('chat/reply/ajax/{code}', [ChatController::class, 'chatReplyAjax']);
    Route::get('chat/remove/{id}', [ChatController::class, 'chatRemove'])->name('chat#chatRemove');
    Route::get('chat/remove/all/conversation', [ChatController::class, 'chatRemoveAllConver'])->name('chat#chatRemoveAllConver');
    Route::post('chat/message', [ChatController::class, 'chat'])->name('chat#chatMessage');
    Route::get('chat/message/reply/{id}', [ChatController::class, 'chatReply'])->name('chat#chatMessageReply');
    Route::get('chat/message/reply/cancel/{id}', [ChatController::class, 'chatReplyCancel'])->name('chat#chatMessageReplyCancel');
    Route::get('chat/message/delete/{id}', [ChatController::class, 'chatMessageDelete'])->name('chat#chatMessageDelete');
    Route::get('chat/message/delete/par/{id}', [ChatController::class, 'chatMessageDeletePar'])->name('chat#chatMessageDeletePar');
    Route::get('chat/message/seen/{id}', [ChatController::class, 'chatSeen']);
    Route::get('chat/message/search', [ChatController::class, 'chatMessageSearch'])->name('chat#chatMessageSearch');

    // group chat
    Route::post('group', [GroupChatController::class, 'group'])->name('group#groupChat');
    Route::post('group/add/member', [GroupChatController::class, 'groupAddMember'])->name('group#groupChatAddMember');
    Route::get('group/remove/member/{id}', [GroupChatController::class, 'groupRemoveMember'])->name('group#groupChatRemoveMember');
    Route::get('group/delete/{id}', [GroupChatController::class, 'groupDelete'])->name('group#groupChatDelete');
    Route::get('group/leave/{id}', [GroupChatController::class, 'groupLeave'])->name('group#groupChatLeave');
    Route::get('group/{id}', [GroupChatController::class, 'groupPage'])->name('group#groupChatPage');
    Route::get('group/ajax/{gpID}', [GroupChatController::class, 'groupChatAjax']);
    Route::get('group/reply/ajax/{code}', [GroupChatController::class, 'replyGroupChatAjax']);
    Route::post('group/message', [GroupChatController::class, 'groupMessage'])->name('group#groupChatMessage');
    Route::get('group/message/delete/{id}', [GroupChatController::class, 'groupMessageDelete'])->name('group#groupChatMessageDelete');
    Route::get('group/message/delete/par/{id}', [GroupChatController::class, 'groupMessageDeletePar'])->name('group#groupChatMessageDeletePar');
    Route::get('group/message/reply/{id}', [GroupChatController::class, 'groupMessageReply'])->name('group#groupChatMessageReply');
    Route::post('group/change/profile', [GroupChatController::class, 'groupProfileChange'])->name('group#groupProfileChange');
    Route::post('group/change/name', [GroupChatController::class, 'groupProfileChangeName'])->name('group#groupProfileChangeName');
    Route::get('group/message/seen/{gpID}', [GroupChatController::class, 'groupSeen']);

    // block people
    Route::get('block/{id}', [BlockChatController::class, 'block'])->name('chat#block');
    Route::get('unblock/{id}', [BlockChatController::class, 'unblock'])->name('chat#unblock');
    Route::get('block/member/ajax/', [BlockChatController::class, 'blockMemberAjax']);
});
