<?php

namespace App\Http\Controllers;

use App\Models\BlockChat;
use App\Models\Chat;
use App\Models\ChatList;
use App\Models\ChatLists;
use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MessageFormatter;

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
        $chatlist = $data[7];
        if(ChatLists::where('fir_user_id',Auth::user()->id)->where('sec_user_id',$id)->first() == null){
            ChatLists::create([
                'fir_user_id' => Auth::user()->id,
                'sec_user_id' => $id
            ]);
        };

        return view('chat.chat', compact('people','chatlist', 'contact', 'chat', 'message', 'imageOrder', 'group', 'block'));
    }

    // chat ajax
    public function chatAjax($id){
        $message = Chat::select('chats.*', 'messages.*')
        ->rightJoin('messages', 'chats.chat_code', 'messages.chat_code')
        ->where('chats.sec_user_id', $id)
        ->orwhere('chats.fir_user_id', $id)
        ->get();

        return response()->json(['message' => $message]);
    }

    // chat message search
    public function chatMessageSearch(){
        $searchMessage = Message::select('chats.*', 'messages.*')
        ->leftJoin('chats', 'chats.chat_code', 'messages.chat_code')
        ->when(request('searchMessage'), function ($query) {
            $query->orWhere('messages.text', 'like', '%' . request('searchMessage') . '%');
            })
        ->get();
        return response()->json(['searchMessage' => $searchMessage]);
    }

    // remove all conversation
    public function chatRemoveAllConver($id){
        Chat::where('fir_user_id',Auth::user()->id)->where('sec_user_id',$id)->delete();
        return back();
    }

    // chat reply ajax
    public function chatReplyAjax($replyCode){
        $replyMessage = Message::select('chats.*', 'messages.*')
        ->leftJoin('chats', 'chats.chat_code', 'messages.chat_code')
        ->where('messages.chat_code',$replyCode)->first();

        return response()->json(['replyMessage' => $replyMessage]);
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
        if ($request->hasFile('audio')) {

            $random = mt_rand(1, 1000000);
            $send = [
                'fir_user_id' => $request->firstUser,
                'sec_user_id' => $request->secUser,
                'chat_code' => $random
            ];

            $fileName = uniqid() . "_" . $request->file('audio')->getClientOriginalName();
            $request->file('audio')->storeAs('public', $fileName);

            $messageSend = [
                'audio' => $fileName,
                'chat_code' => $random,
            ];
            $request->replyCode == 'undefined' ? $messageSend['reply_chat_code'] = null : $messageSend['reply_chat_code'] = $request->replyCode;

        } else {
            $request->validate([
                'file' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,video/mp4,video/mpeg,video/quicktime',
            ]);

            $random = mt_rand(1, 1000000);
            $send = [
                'fir_user_id' => $request->firstUser,
                'sec_user_id' => $request->secUser,
                'chat_code' => $random
            ];
            $messageSend = [
                'text' => $request->message,
                'chat_code' => $random,
            ];
            $request->replyCode == 'undefined' ? $messageSend['reply_chat_code'] = null : $messageSend['reply_chat_code'] = $request->replyCode;
            $request->replyText == 'undefined' ? $messageSend['reply_mes'] = null : $messageSend['reply_mes'] = $request->replyText;

            if ($request->hasFile('file')) {
                $fileName = uniqid() . "_" . $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs('public', $fileName);
                if($request->file('file')->getMimeType() == "image/jpeg" || $request->file('file')->getMimeType() == "image/jpg" || $request->file('file')->getMimeType() == "image/png" || $request->file('file')->getMimeType() == "image/webp"){
                    $messageSend['image'] = $fileName;
                }
                if($request->file('file')->getMimeType() == "video/mp4" || $request->file('file')->getMimeType() == "video/mpeg" || $request->file('file')->getMimeType() == "video/ogg" || $request->file('file')->getMimeType() == "video/webm"){
                    $messageSend['video'] = $fileName;
                }
            }

        }
        Chat::create($send);
        Message::create($messageSend);
       if(ChatLists::where('fir_user_id',$request->secUser)->where('sec_user_id', $request->firstUser)->first() == null){
            ChatLists::create([
                'fir_user_id' => $request->secUser,
                'sec_user_id' => $request->firstUser
            ]);
       }

       return response()->json(['success' => 'success']);
    }

    // chat reply
    public function chatReply($code)
    {
        $reply = Chat::select('messages.*', 'chats.*')
            ->leftJoin('messages', 'chats.chat_code', 'messages.chat_code')
            ->where('chats.chat_code', $code)->first();

            return response()->json(['reply' => $reply]);
    }

    // chat reply cancel
    public function chatReplyCancel($id)
    {
        return redirect()->route('chat#chatPage', $id);
    }

    // chat message delete
    public function chatMessageDelete($code)
    {
        $m = Message::where('chat_code', $code)->first();
        if ($m->audio != null) {
            Message::where('chat_code', $code)->update(['audio' => null]);
        } elseif ($m->image != null && $m->text != null) {
            Message::where('chat_code', $code)->update([
                'text' => null,
                'image' => null
            ]);
        }  elseif ($m->video != null && $m->text != null) {
            Message::where('chat_code', $code)->update([
                'text' => null,
                'video' => null
            ]);
        } elseif ($m->image != null) {
            Message::where('chat_code', $code)->update(['image' => null]);
        } elseif ($m->video != null) {
            Message::where('chat_code', $code)->update(['video' => null]);
        } elseif ($m->text != null) {
            Message::where('chat_code', $code)->update(['text' => null]);
        }

        return response()->json(['success' => 'success']);
    }

    // chat message par delete
    public function chatMessageDeletePar($code)
    {
        Message::where('chat_code', $code)->delete();

        return response()->json(['success' => 'success']);
    }

    // chat message seen
    public function chatSeen($id)
    {
        Chat::where('fir_user_id', $id)->where('sec_user_id', Auth::user()->id)->update(['status' => 'seen']);
    }

    // Call back for chat page
    private function CallBackChatPage($id)
    {
        $blockId = BlockChat::pluck('blocked_id');

        $people = User::whereNotIn('id', $blockId)->get();
        $contact = Contact::select('users.*', 'contacts.id', 'contacts.user_id', 'contacts.add_user_id')
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

        $block = BlockChat::where('user_id', Auth::user()->id)->get();

        $chatlist = ChatLists::select('chat_lists.fir_user_id','chat_lists.sec_user_id','users.*')
            ->rightJoin('users','chat_lists.sec_user_id','users.id')
            ->where('chat_lists.fir_user_id',Auth::user()->id)
            ->get();


        return [$people, $contact, $chat, $message, $imageOrder, $group, $block ,$chatlist];
    }
}
