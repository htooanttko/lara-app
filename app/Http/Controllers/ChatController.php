<?php

namespace App\Http\Controllers;

use App\Models\BlockChat;
use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // direct chat
    public function chatPage($id)
    {
        $data = $this->CallBackChatPage($id);
        $people = $data[0];
        $contact = $data[1];
        $chat = $data[2];
        $message = $data[3];
        $imageOrder = $data[4];
        $group = $data[5];
        $block = $data[6];
        $blocked = $data[7];

        return view('chat.chat', compact('people', 'contact', 'chat', 'message', 'imageOrder', 'group','block','blocked'));
    }

    // remove Chat
    public function chatRemove($id)
    {
        Chat::where('fir_user_id', $id)->orWhere('sec_user_id', $id)->delete();
        return back();
    }

    // chat message
    public function chat(Request $request)
    {
        $random = mt_rand(1, 1000000);
        $send = [
            'fir_user_id' => $request->firstUser,
            'sec_user_id' => $request->secUser,
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

        return redirect()->route('chat#chatPage', $request->secUser);
    }

    // chat reply
    public function chatReply($code)
    {
        $reply = Chat::select('messages.*', 'chats.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.chat_code', $code)->first();

        if (Auth::user()->id == $reply->sec_user_id) {
            $data = $this->CallBackChatPage($reply->fir_user_id);
        } else {
            $data = $this->CallBackChatPage($reply->sec_user_id);
        }

        $people = $data[0];
        $contact = $data[1];
        $chat = $data[2];
        $message = $data[3];
        $imageOrder = $data[4];
        $group = $data[5];
        $block = $data[6];
        $blocked = $data[7];

        return view('chat.chat', compact('people', 'contact', 'chat', 'message', 'imageOrder', 'group', 'reply','block','blocked'));
    }

    // chat reply cancel
    public function chatReplyCancel($id)
    {
        return redirect()->route('chat#chatPage', $id);
    }

    // chat message delete
    public function chatMessageDelete($code)
    {
        Message::where('chat_code', $code)->update(['text'=>null]);
        return back();
    }

    // chat message par delete
    public function chatMessageDeletePar($code){
        Message::where('chat_code', $code)->delete();
        $id = Chat::where('chat_code',$code)->first();

        return redirect()->route('chat#chatPage',$id->sec_user_id);
    }

    // chat message seen 
    public function chatSeen(Request $request){
        Chat::where('fir_user_id',$request->id)->where('sec_user_id',Auth::user()->id)->update(['status'=>'seen']);
    }

    // Call back for chat page
    private function CallBackChatPage($id)
    {
        $blockId = BlockChat::pluck('blocked_id');

        $people = User::whereNotIn('id',$blockId)->get();
        $contact = Contact::select('users.*','contacts.id','contacts.user_id','contacts.add_user_id')
            ->leftJoin('users', 'contacts.add_user_id', 'users.id')
            ->where('contacts.user_id', Auth::user()->id)
            ->get();

        $chat = User::where('id', $id)->first();

        $message = Chat::select('chats.*', 'messages.*')
            ->rightJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id', $id)
            ->orwhere('chats.fir_user_id', $id)
            ->get();

        $imageOrder = Chat::select('chats.*', 'messages.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.sec_user_id', $id)
            ->orwhere('chats.fir_user_id', $id)
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

        $block = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.user_id',Auth::user()->id)->get();

        $blocked = BlockChat::select('block_chats.*','users.*')
            ->leftJoin('users','block_chats.blocked_id','users.id')
            ->where('block_chats.blocked_id',Auth::user()->id)->get();

        // dd($blocked->toArray());

        return [$people, $contact, $chat, $message, $imageOrder, $group,$block,$blocked];
    }
}
