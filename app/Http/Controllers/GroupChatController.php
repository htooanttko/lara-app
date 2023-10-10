<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Message;
use App\Models\BlockChat;
use App\Models\GroupChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ChatList;
use App\Models\ChatLists;

class GroupChatController extends Controller
{
    // group chat ajax
    public function groupChatAjax($gpID){
        $message = GroupChat::select('group_chats.*', 'messages.*')
        ->rightJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
        ->where('group_chats.gp_id', $gpID)
        ->get();
        return response()->json(['message' => $message]);
    }

    // reply group chat ajax
    public function replyGroupChatAjax($replyCode){
        $replyMessage = Message::select('group_chats.*', 'messages.*')
        ->leftJoin('group_chats', 'group_chats.chat_code', 'messages.chat_code')
        ->where('messages.chat_code',$replyCode)->first();

        return response()->json(['replyMessage' => $replyMessage]);
    }

    // create group chat
    public function group(Request $request)
    {
        $key = array_keys($request->toArray());

        if (count($key) >= 13) {
            return back()->with(['exceedMember' => '...']);
        }

        if (count($key) < 4) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
            ];
        } elseif (count($key) < 5) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id
            ];
        } elseif (count($key) < 6) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id
            ];
        } elseif (count($key) < 7) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id
            ];
        } elseif (count($key) < 8) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id
            ];
        } elseif (count($key) < 9) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $m6 = Contact::where('add_user_id', $key[7])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id
            ];
        } elseif (count($key) < 10) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $m6 = Contact::where('add_user_id', $key[7])->first();
            $m7 = Contact::where('add_user_id', $key[8])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id
            ];
        } elseif (count($key) < 11) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $m6 = Contact::where('add_user_id', $key[7])->first();
            $m7 = Contact::where('add_user_id', $key[8])->first();
            $m8 = Contact::where('add_user_id', $key[9])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id
            ];
        } elseif (count($key) < 12) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $m6 = Contact::where('add_user_id', $key[7])->first();
            $m7 = Contact::where('add_user_id', $key[8])->first();
            $m8 = Contact::where('add_user_id', $key[9])->first();
            $m9 = Contact::where('add_user_id', $key[10])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id,
                'g_user_id' => $m9->add_user_id
            ];
        } elseif (count($key) < 13) {
            $m1 = Contact::where('add_user_id', $key[2])->first();
            $m2 = Contact::where('add_user_id', $key[3])->first();
            $m3 = Contact::where('add_user_id', $key[4])->first();
            $m4 = Contact::where('add_user_id', $key[5])->first();
            $m5 = Contact::where('add_user_id', $key[6])->first();
            $m6 = Contact::where('add_user_id', $key[7])->first();
            $m7 = Contact::where('add_user_id', $key[8])->first();
            $m8 = Contact::where('add_user_id', $key[9])->first();
            $m9 = Contact::where('add_user_id', $key[10])->first();
            $m10 = Contact::where('add_user_id', $key[11])->first();
            $data = [
                'user_id' =>  Auth::user()->id,
                'group_name' => $request->groupName,
                'fir_user_id' =>  $m1->add_user_id,
                'sec_user_id' =>  $m2->add_user_id,
                'a_user_id' => $m3->add_user_id,
                'b_user_id' => $m4->add_user_id,
                'c_user_id' => $m5->add_user_id,
                'd_user_id' => $m6->add_user_id,
                'e_user_id' => $m7->add_user_id,
                'f_user_id' => $m8->add_user_id,
                'g_user_id' => $m9->add_user_id,
                'h_user_id' => $m10->add_user_id
            ];
        }

        $groupChat = Group::create($data);

        return redirect()->route('group#groupChatPage',$groupChat->id);
    }

    // direct group chat page
    public function groupPage($id)
    {
        $groupChat = Group::where('id', $id)->first();

        $data1 = $this->CallBackGpChatPage1();
        $data = $this->CallBackGpChatPage($groupChat);

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $chatlist = $data1[4];

        $user = $data[0];
        $firUser = $data[1];
        $secUser = $data[2];
        $aUser = $data[3];
        $bUser = $data[4];
        $cUser = $data[5];
        $dUser = $data[6];
        $eUser = $data[7];
        $fUser = $data[8];
        $gUser = $data[9];
        $hUser = $data[10];
        $message = $data[11];
        $imageOrder = $data[12];
        $memberPic = $data[13];

        return view('chat.groupchat', compact('chatlist','people', 'contact', 'group', 'groupChat', 'message', 'imageOrder', 'user', 'firUser', 'secUser', 'aUser', 'bUser', 'cUser', 'dUser', 'eUser', 'fUser', 'gUser', 'hUser', 'block'));
    }

    // group chat message
    public function groupMessage(Request $request)
    {
        logger($request);
            $random = mt_rand(1, 1000000);
            $chat = [
                'gp_id' => $request->gpID,
                'user_id' => $request->userId,
                'fir_user_id' => $request->firstUser,
                'chat_code' => $random
            ];

            if ($request->secUser != 'undefined') {
                $chat['sec_user_id'] = $request->secUser;
            };
            if ($request->aUser != 'undefined') {
                $chat['a_user_id'] = $request->aUser;
            };
            if ($request->bUser != 'undefined') {
                $chat['b_user_id'] = $request->bUser;
            };
            if ($request->cUser != 'undefined') {
                $chat['c_user_id'] = $request->cUser;
            };
            if ($request->dUser != 'undefined') {
                $chat['d_user_id'] = $request->dUser;
            };
            if ($request->eUser != 'undefined') {
                $chat['e_user_id'] = $request->eUser;
            };
            if ($request->fUser != 'undefined') {
                $chat['f_user_id'] = $request->fUser;
            };
            if ($request->gUser != 'undefined') {
                $chat['g_user_id'] = $request->gUser;
            };
            if ($request->hUser != 'undefined') {
                $chat['h_user_id'] = $request->hUser;
            };

        if ($request->hasFile('audio')) {

            $fileName = uniqid() . "_" . $request->file('audio')->getClientOriginalName();
            $request->file('audio')->storeAs('public', $fileName);
            $message = [
                'audio' => $fileName,
                'chat_code' => $random,
            ];
            $request->replyCode == 'undefined' ? $message['reply_chat_code'] = null : $message['reply_chat_code'] = $request->replyCode;
        } else {
            $request->validate([
                'file' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,video/mp4,video/mpeg,video/quicktime',
            ]);
            $message = [
                'text' => $request->message,
                'chat_code' => $random,
            ];
            $request->replyCode == 'undefined' ? $message['reply_chat_code'] = null : $message['reply_chat_code'] = $request->replyCode;
            $request->replyText == 'undefined' ? $message['reply_mes'] = null : $message['reply_mes'] = $request->replyText;

            if ($request->hasFile('file')) {
                $fileName = uniqid() . "_" . $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs('public', $fileName);
                if($request->file('file')->getMimeType() == "image/jpeg" || $request->file('file')->getMimeType() == "image/jpg" || $request->file('file')->getMimeType() == "image/png" || $request->file('file')->getMimeType() == "image/webp"){
                    $message['image'] = $fileName;
                }
                if($request->file('file')->getMimeType() == "video/mp4" || $request->file('file')->getMimeType() == "video/mpeg" || $request->file('file')->getMimeType() == "video/ogg" || $request->file('file')->getMimeType() == "video/webm"){
                    $message['video'] = $fileName;
                }
            }
        }

        GroupChat::create($chat);
        Message::create($message);

        return response()->json(['success' => 'success']);
    }

    // change group profile
    public function groupProfileChange(Request $request)
    {
        $oldPhotoName = Group::select('group_image')->where('id', $request->id)->first();
        $oldPhotoName = $oldPhotoName['group_image'];

        if ($oldPhotoName != null) {
            Storage::delete('public/' . $oldPhotoName);
        }

        $folderPath = public_path('storage/');

        $image_parts = explode(";base64,", $request->image); // data:image/png
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath . $imageName;
        file_put_contents($imageFullPath, $image_base64);

        $upload['group_image'] = $imageName;

        Group::where('id', $request->id)->update($upload);

        return response()->json([
            'id' => $request->id,
        ]);
    }

    // group change name
    public function groupProfileChangeName(Request $request)
    {
        $data = ['group_name' => $request->gpname];
        Group::where('id', $request->id)->update($data);
        return back();
    }

    // group delete
    public function groupDelete($id)
    {
        Group::where('id', $id)->delete();

        return redirect()->route('dashboard');
    }

    // group leave
    public function groupLeave($id)
    {

        if (Group::where('fir_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['fir_user_id' => null];
        } elseif (Group::where('sec_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['sec_user_id' => null];
        } elseif (Group::where('a_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['a_user_id' => null];
        } elseif (Group::where('b_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['b_user_id' => null];
        } elseif (Group::where('c_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['c_user_id' => null];
        } elseif (Group::where('d_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['d_user_id' => null];
        } elseif (Group::where('e_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['e_user_id' => null];
        } elseif (Group::where('f_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['f_user_id' => null];
        } elseif (Group::where('g_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['g_user_id' => null];
        } elseif (Group::where('h_user_id', Auth::user()->id)->first()) {
            $deleteUser = ['h_user_id' => null];
        }

        Group::where('id', $id)->update($deleteUser);

        GroupChat::select('group_chats.*', 'messages.*')
            ->leftJoin("messages", 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.user_id', Auth::user()->id)
            ->delete();

        $data1 = $this->CallBackGpChatPage1();

        $people = $data1[0];
        $contact = $data1[1];
        $group = $data1[2];
        $block = $data1[3];
        $blocked = $data1[4];

        return redirect()->route('dashboard');
    }

    // add member
    public function groupAddMember(Request $request)
    {
        $key = array_keys($request->toArray());
        if(count($key) < 3){
            return back()->with(['errorselect' => 'select member']);
        }
        $member = Group::where('id', $request->gpID)->first();

        if ($member->sec_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['sec_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id
                ];
            } elseif (count($key) < 11) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id,
                    'g_user_id' => $m8->add_user_id
                ];
            } elseif (count($key) < 12) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $m9 = Contact::where('add_user_id', $key[10])->first();
                $data = [
                    'sec_user_id' =>  $m1->add_user_id,
                    'a_user_id' =>  $m2->add_user_id,
                    'b_user_id' => $m3->add_user_id,
                    'c_user_id' => $m4->add_user_id,
                    'd_user_id' => $m5->add_user_id,
                    'e_user_id' => $m6->add_user_id,
                    'f_user_id' => $m7->add_user_id,
                    'g_user_id' => $m8->add_user_id,
                    'h_user_id' => $m9->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['a_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id,
                    'g_user_id' => $m7->add_user_id
                ];
            } elseif (count($key) < 11) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $m8 = Contact::where('add_user_id', $key[9])->first();
                $data = [
                    'a_user_id' =>  $m1->add_user_id,
                    'b_user_id' =>  $m2->add_user_id,
                    'c_user_id' => $m3->add_user_id,
                    'd_user_id' => $m4->add_user_id,
                    'e_user_id' => $m5->add_user_id,
                    'f_user_id' => $m6->add_user_id,
                    'g_user_id' => $m7->add_user_id,
                    'h_user_id' => $m8->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['b_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id,
                    'g_user_id' => $m6->add_user_id
                ];
            } elseif (count($key) < 10) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $m7 = Contact::where('add_user_id', $key[8])->first();
                $data = [
                    'b_user_id' =>  $m1->add_user_id,
                    'c_user_id' =>  $m2->add_user_id,
                    'd_user_id' => $m3->add_user_id,
                    'e_user_id' => $m4->add_user_id,
                    'f_user_id' => $m5->add_user_id,
                    'g_user_id' => $m6->add_user_id,
                    'h_user_id' => $m7->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['c_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id,
                    'g_user_id' => $m5->add_user_id
                ];
            } elseif (count($key) < 9) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $m6 = Contact::where('add_user_id', $key[7])->first();
                $data = [
                    'c_user_id' =>  $m1->add_user_id,
                    'd_user_id' =>  $m2->add_user_id,
                    'e_user_id' => $m3->add_user_id,
                    'f_user_id' => $m4->add_user_id,
                    'g_user_id' => $m5->add_user_id,
                    'h_user_id' => $m6->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['d_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id,
                    'g_user_id' => $m4->add_user_id
                ];
            } elseif (count($key) < 8) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $m5 = Contact::where('add_user_id', $key[6])->first();
                $data = [
                    'd_user_id' =>  $m1->add_user_id,
                    'e_user_id' =>  $m2->add_user_id,
                    'f_user_id' => $m3->add_user_id,
                    'g_user_id' => $m4->add_user_id,
                    'h_user_id' => $m5->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['e_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id,
                    'g_user_id' => $m3->add_user_id
                ];
            } elseif (count($key) < 7) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $m4 = Contact::where('add_user_id', $key[5])->first();
                $data = [
                    'e_user_id' =>  $m1->add_user_id,
                    'f_user_id' =>  $m2->add_user_id,
                    'g_user_id' => $m3->add_user_id,
                    'h_user_id' => $m4->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['f_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'f_user_id' =>  $m1->add_user_id,
                    'g_user_id' =>  $m2->add_user_id
                ];
            } elseif (count($key) < 6) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $m3 = Contact::where('add_user_id', $key[4])->first();
                $data = [
                    'f_user_id' =>  $m1->add_user_id,
                    'g_user_id' =>  $m2->add_user_id,
                    'h_user_id' => $m3->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id != null && $member->g_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['g_user_id' =>  $m1->add_user_id];
            } elseif (count($key) < 5) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $m2 = Contact::where('add_user_id', $key[3])->first();
                $data = [
                    'g_user_id' =>  $m1->add_user_id,
                    'h_user_id' =>  $m2->add_user_id
                ];
            }
        } elseif ($member->sec_user_id != null && $member->a_user_id != null && $member->b_user_id != null && $member->c_user_id != null && $member->d_user_id != null && $member->e_user_id != null && $member->f_user_id != null && $member->g_user_id != null && $member->h_user_id == null) {
            if (count($key) < 4) {
                $m1 = Contact::where('add_user_id', $key[2])->first();
                $data = ['h_user_id' =>  $m1->add_user_id];
            }
        }
        Group::where('id', $request->gpID)->update($data);
        return back();
    }

    // remove member
    public function groupRemoveMember($id)
    {
        if (Group::where('fir_user_id', $id)->first()) {
            $remove = Group::where('fir_user_id', $id)->first();
            $data = [
                'fir_user_id' => $remove->sec_user_id,
                'sec_user_id' => $remove->a_user_id,
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('sec_user_id', $id)->first()) {
            $remove = Group::where('sec_user_id', $id)->first();
            $data = [
                'sec_user_id' => $remove->a_user_id,
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('a_user_id', $id)->first()) {
            $remove = Group::where('a_user_id', $id)->first();
            $data = [
                'a_user_id' => $remove->b_user_id,
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('b_user_id', $id)->first()) {
            $remove = Group::where('b_user_id', $id)->first();
            $data = [
                'b_user_id' => $remove->c_user_id,
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('c_user_id', $id)->first()) {
            $remove = Group::where('c_user_id', $id)->first();
            $data = [
                'c_user_id' => $remove->d_user_id,
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('d_user_id', $id)->first()) {
            $remove = Group::where('d_user_id', $id)->first();
            $data = [
                'd_user_id' => $remove->e_user_id,
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('e_user_id', $id)->first()) {
            $remove = Group::where('e_user_id', $id)->first();
            $data = [
                'e_user_id' => $remove->f_user_id,
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('f_user_id', $id)->first()) {
            $remove = Group::where('f_user_id', $id)->first();
            $data = [
                'f_user_id' => $remove->g_user_id,
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('g_user_id', $id)->first()) {
            $remove = Group::where('g_user_id', $id)->first();
            $data = [
                'g_user_id' => $remove->h_user_id,
                'h_user_id' => null
            ];
        } elseif (Group::where('h_user_id', $id)->first()) {
            $data = [
                'h_user_id' => null
            ];
        }

        Group::where('fir_user_id', $id)->orwhere('sec_user_id', $id)
            ->orwhere('a_user_id', $id)->orwhere('b_user_id', $id)
            ->orwhere('c_user_id', $id)->orwhere('d_user_id', $id)
            ->orwhere('e_user_id', $id)->orwhere('f_user_id', $id)
            ->orwhere('g_user_id', $id)->orwhere('h_user_id', $id)->update($data);

        return back();
    }

    // group chat message delete
    public function groupMessageDelete($code)
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
    public function groupMessageDeletePar($code)
    {
        Message::where('chat_code', $code)->delete();
        return response()->json(['success' => 'success']);
    }

    // group chat message reply
    public function groupMessageReply($code)
    {
        $reply = GroupChat::select('messages.*', 'group_chats.*')
            ->leftJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.chat_code', $code)->first();

        return response()->json(['reply' => $reply]);
    }

    // group message seen
    public function groupSeen($gpID)
    {
        if (GroupChat::where('gp_id', $gpID)->where('fir_user_id', Auth::user()->id)->first()) {
            $seen = ['fir_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('sec_user_id', Auth::user()->id)->first()) {
            $seen = ['sec_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('a_user_id', Auth::user()->id)->first()) {
            $seen = ['a_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('b_user_id', Auth::user()->id)->first()) {
            $seen = ['b_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('c_user_id', Auth::user()->id)->first()) {
            $seen = ['c_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('d_user_id', Auth::user()->id)->first()) {
            $seen = ['d_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('e_user_id', Auth::user()->id)->first()) {
            $seen = ['e_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('f_user_id', Auth::user()->id)->first()) {
            $seen = ['f_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('g_user_id', Auth::user()->id)->first()) {
            $seen = ['g_status' => 'seen'];
        }
        if (GroupChat::where('gp_id', $gpID)->where('h_user_id', Auth::user()->id)->first()) {
            $seen = ['h_status' => 'seen'];
        }

            GroupChat::where('gp_id', $gpID)
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
                ->orwhere('h_user_id', Auth::user()->id)->update($seen);

    }

    // call back for gp chat page
    private function CallBackGpChatPage($id)
    {
        $user = User::where('id', $id->user_id)->first();
        $firUser = User::where('id', $id->fir_user_id)->first();
        $secUser = User::where('id', $id->sec_user_id)->first();
        $aUser = User::where('id', $id->a_user_id)->first();
        $bUser = User::where('id', $id->b_user_id)->first();
        $cUser = User::where('id', $id->c_user_id)->first();
        $dUser = User::where('id', $id->d_user_id)->first();
        $eUser = User::where('id', $id->e_user_id)->first();
        $fUser = User::where('id', $id->f_user_id)->first();
        $gUser = User::where('id', $id->g_user_id)->first();
        $hUser = User::where('id', $id->h_user_id)->first();

        $message = GroupChat::select('group_chats.*', 'messages.*')
            ->rightJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.gp_id', $id->id)
            ->get();

        $imageOrder = GroupChat::select('group_chats.*', 'messages.*')
            ->leftJoin('messages', 'group_chats.chat_code', 'messages.chat_code')
            ->where('group_chats.gp_id', $id->id)
            ->orderBy('messages.created_at', 'desc')
            ->get();

        $memberPic = GroupChat::select('group_chats.*', 'users.*')
            ->leftJoin('users', 'group_chats.user_id', 'users.id')->where('users.id', 'group_chats.user_id')->get();

        return [$user, $firUser, $secUser, $aUser, $bUser, $cUser, $dUser, $eUser, $fUser, $gUser, $hUser, $message, $imageOrder, $memberPic];
    }

    // call back chat page 2
    private function CallBackGpChatPage1()
    {
        $people = User::get();
        $contact = Contact::select('users.*', 'contacts.id', 'contacts.user_id', 'contacts.add_user_id')
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

        $block = BlockChat::where('user_id', Auth::user()->id)->get();

        $chatlist = ChatLists::select('chat_lists.fir_user_id','chat_lists.sec_user_id','users.*')
            ->rightJoin('users','chat_lists.sec_user_id','users.id')
            ->where('chat_lists.fir_user_id',Auth::user()->id)
            ->get();

        return [$people, $contact, $group, $block ,$chatlist];
    }
}
