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


Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});

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
    Route::post('account/name/update', [UserController::class, 'accountName'])->name('profile#accountName');
    Route::post('account/phone/update', [UserController::class, 'accountPhone'])->name('profile#accountPhone');
    Route::post('account/email/update', [UserController::class, 'accountEmail'])->name('profile#accountEmail');
    Route::post('account/bio/update', [UserController::class, 'accountBio'])->name('profile#accountBio');
    Route::post('account/image/update', [UserController::class, 'accountImage'])->name('profile#accountImage');
    Route::post('account/password/change', [UserController::class, 'passwordChange'])->name('profile#accountPasswordChange');

    // contact add
    Route::post('contact/add', [ContactController::class, 'addContact'])->name('contact#addContact');

    // save message
    Route::get('save/message', [SaveChatController::class, 'saveChat'])->name('chat#saveMessage');
    Route::get('save/message/clear', [SaveChatController::class, 'saveChatClearAll'])->name('chat#saveMessageClearAll');
    Route::post('save/message/send', [SaveChatController::class, 'saveSendChat'])->name('chat#saveSendMessage');
    Route::get('save/message/send/reply/{id}', [SaveChatController::class, 'saveSendChatReply'])->name('chat#saveSendMessageReply');
    Route::get('save/message/send/reply/cancel/{id}', [SaveChatController::class, 'saveSendChatReplyCancel'])->name('chat#saveSendMessageReplyCancel');
    Route::get('save/message/send/delete/{id}', [SaveChatController::class, 'saveSendChatDelete'])->name('chat#saveSendMessageDelete');
    Route::get('save/message/send/delete/par/{id}', [SaveChatController::class, 'saveSendChatDeletePar'])->name('chat#saveSendMessageDeletePar');

    // chat
    Route::get('chat/{id}', [ChatController::class, 'chatPage'])->name('chat#chatPage');
    Route::get('chat/remove/{id}', [ChatController::class, 'chatRemove'])->name('chat#chatRemove');
    Route::post('chat/message', [ChatController::class, 'chat'])->name('chat#chatMessage');
    Route::get('chat/message/reply/{id}', [ChatController::class, 'chatReply'])->name('chat#chatMessageReply');
    Route::get('chat/message/reply/cancel/{id}', [ChatController::class, 'chatReplyCancel'])->name('chat#chatMessageReplyCancel');
    Route::get('chat/message/delete/{id}', [ChatController::class, 'chatMessageDelete'])->name('chat#chatMessageDelete');
    Route::get('chat/message/delete/par/{id}', [ChatController::class, 'chatMessageDeletePar'])->name('chat#chatMessageDeletePar');
    Route::get('chat/message/seen', [ChatController::class, 'chatSeen'])->name('chat#chatSeen');

    // group chat
    Route::post('group', [GroupChatController::class, 'group'])->name('group#groupChat');
    Route::post('group/add/member', [GroupChatController::class, 'groupAddMember'])->name('group#groupChatAddMember');
    Route::get('group/remove/member/{id}', [GroupChatController::class, 'groupRemoveMember'])->name('group#groupChatRemoveMember');
    Route::get('group/delete/{id}', [GroupChatController::class, 'groupDelete'])->name('group#groupChatDelete');
    Route::get('group/leave/{id}', [GroupChatController::class, 'groupLeave'])->name('group#groupChatLeave');
    Route::get('group/{id}', [GroupChatController::class, 'groupPage'])->name('group#groupChatPage');
    Route::post('group/message', [GroupChatController::class, 'groupMessage'])->name('group#groupChatMessage');
    Route::get('group/message/delete/{id}', [GroupChatController::class, 'groupMessageDelete'])->name('group#groupChatMessageDelete');
    Route::get('group/message/delete/par/{id}', [GroupChatController::class, 'groupMessageDeletePar'])->name('group#groupChatMessageDeletePar');
    Route::get('group/message/reply/{id}', [GroupChatController::class, 'groupMessageReply'])->name('group#groupChatMessageReply');
    Route::post('group/change/profile', [GroupChatController::class, 'groupProfileChange'])->name('group#groupProfileChange');
    Route::post('group/change/name', [GroupChatController::class, 'groupProfileChangeName'])->name('group#groupProfileChangeName');
    Route::get('group/message/seen', [GroupChatController::class, 'groupSeen'])->name('group#groupSeen');

    // block people
    Route::get('block/{id}', [BlockChatController::class, 'block'])->name('chat#block');
    Route::get('unblock/{id}', [BlockChatController::class, 'unblock'])->name('chat#unblock');
});
