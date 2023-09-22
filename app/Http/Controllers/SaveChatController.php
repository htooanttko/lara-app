<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use App\Models\BlockChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveChatController extends Controller
{
    // direct save chat page
    public function saveChat()
    {
        $people = User::get();
        $contact = Contact::select('users.*', 'contacts.*')
            ->leftJoin('users', 'contacts.add_user_id', 'users.id')
            ->where('contacts.user_id', Auth::user()->id)
            ->get();
        $group = Group::where('user_id', Auth::user()->id)
            ->orwhere('user_id', Auth::user()->id)
            ->orwhere('fir_user_id', Auth::user()->id)
            ->orwhere('sec_user_id', Auth::user()->id)
            ->orwhere('a_user_id', Auth::user()->id)
            ->orwhere('b_user_id', Auth::user()->id)
            ->orwhere('c_user_id', Auth::user()->id)
            ->orwhere('d_user_id', Auth::user()->id)
            ->orwhere('e_user_id', Auth::user()->id)
            ->orwhere('f_user_id', Auth::user()->id)
            ->orwhere('g_user_id', Auth::user()->id)
            ->orwhere('h_user_id', Auth::user()->id)->get();

        $message = Chat::select('chats.*', 'messages.*')
            ->rightJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id', Auth::user()->id)
            ->orwhere('chats.fir_user_id', Auth::user()->id)
            ->get();

        $imageOrder = Chat::select('chats.*', 'messages.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id', Auth::user()->id)
            ->orwhere('chats.fir_user_id', Auth::user()->id)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $block = BlockChat::select('block_chats.*', 'users.*')
            ->leftJoin('users', 'block_chats.blocked_id', 'users.id')
            ->where('block_chats.user_id', Auth::user()->id)->get();

        return view('chat.savechat', compact('people', 'contact', 'group', 'message', 'imageOrder', 'block'));
    }

    // send message
    public function saveSendChat(Request $request)
    {
        $random = mt_rand(1, 1000000);
        $send = [
            'fir_user_id' => Auth::user()->id,
            'sec_user_id' => Auth::user()->id,
            'chat_code' => $random
        ];

        $messageSend = [
            'text' => $request->message,
            'chat_code' => $random,
            'reply_chat_code' => $request->replyCode
        ];

        if ($request->hasFile('image')) {
            $fileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $messageSend['image'] = $fileName;
        }

        Chat::create($send);
        Message::create($messageSend);

        return redirect()->route('chat#saveMessage');
    }

    // reply
    public function saveSendChatReply($code)
    {
        $reply = Chat::select('messages.*', 'chats.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.chat_code', $code)->first();

        $people = User::get();
        $contact = Contact::select('users.*', 'contacts.*')
            ->leftJoin('users', 'contacts.add_user_id', 'users.id')
            ->where('contacts.user_id', Auth::user()->id)
            ->get();


        $message = Chat::select('chats.*', 'messages.*')
            ->rightJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id', Auth::user()->id)
            ->orwhere('chats.fir_user_id', Auth::user()->id)
            ->get();

        $imageOrder = Chat::select('chats.*', 'messages.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id',  Auth::user()->id)
            ->orwhere('chats.fir_user_id',  Auth::user()->id)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $group = Group::where('user_id', Auth::user()->id)
            ->orwhere('user_id', Auth::user()->id)
            ->orwhere('fir_user_id', Auth::user()->id)
            ->orwhere('sec_user_id', Auth::user()->id)
            ->orwhere('a_user_id', Auth::user()->id)
            ->orwhere('b_user_id', Auth::user()->id)
            ->orwhere('c_user_id', Auth::user()->id)
            ->orwhere('d_user_id', Auth::user()->id)
            ->orwhere('e_user_id', Auth::user()->id)
            ->orwhere('f_user_id', Auth::user()->id)
            ->orwhere('g_user_id', Auth::user()->id)
            ->orwhere('h_user_id', Auth::user()->id)->get();

        $block = BlockChat::select('block_chats.*', 'users.*')
            ->leftJoin('users', 'block_chats.blocked_id', 'users.id')
            ->where('block_chats.user_id', Auth::user()->id)->get();

        return view('chat.savechat', compact('people', 'contact', 'message', 'imageOrder', 'group', 'reply','block'));
    }

    // reply cancel
    public function saveSendChatReplyCancel($id)
    {
        return redirect()->route('chat#saveMessage');
    }

    // save message delete
    public function saveSendChatDelete($code)
    {
        Message::where('chat_code', $code)->update(['text' => null]);
        return back();
    }

    // save message par delete
    public function saveSendChatDeletePar($code)
    {
        Message::where('chat_code', $code)->delete();
        $id = Chat::where('chat_code', $code)->first();

        return redirect()->route('chat#saveMessage');
    }

    // save message clear all
    public function saveChatClearAll()
    {
        Chat::where('fir_user_id', Auth::user()->id)->where('sec_user_id', Auth::user()->id)->delete();
        return back();
    }
}
